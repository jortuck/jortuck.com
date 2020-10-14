<?php

namespace App\Http\Controllers\Api;

use App\ApiKey;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Github extends Controller
{
    function SendGitEmbed($embed)
    {
        $request = json_encode([
            "content" => "",
            "embeds" => [$embed]
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $ch = curl_init(env('GUTHUB_DISCORD_WEBHOOKURL'));
        curl_setopt_array($ch, [
            CURLOPT_POST => 1,
            CURLOPT_FOLLOWLOCATION => 1,
            CURLOPT_HTTPHEADER => array("Content-type: application/json"),
            CURLOPT_POSTFIELDS => $request,
            CURLOPT_RETURNTRANSFER => 1
        ]);
        curl_exec($ch);
    }
    function Webhook(Request $request)
    {
        $apikey = $request->header('X-Hub-Signature');
        if ($apikey != null) {
            $postBody = file_get_contents('php://input');
            if ($apikey == 'sha1=' . hash_hmac('sha1', $postBody, env('GITHUB_WEBHOOK_SECRET'), false)) {
                if ($request->post('payload') != null) {
                    $data = json_decode($request->post('payload'), true);
                    $repo = $data['repository'];
                    $owner = $repo['owner'];
                    $sender = $data['sender'];
                    switch ($request->header('X-GitHub-Event')) {
                        case "push":
                            $commits = $data['commits'];
                            $fields = array();
                            $ccount = count($commits);
                            if ($ccount != 0) {
                                foreach ($commits as $commit) {
                                    $commtlink = $commit['url'];
                                    if (strpos($commit['message'], "!hide") !== false) {
                                        $value = "*Commit message hidden*";
                                    } else {
                                        $value = "([`Link`]($commtlink)) " . $commit['message'];
                                    }
                                    array_push($fields, array("name" => "Commit from " . $commit['committer']['username'] . " - " . date("n/j/Y g:i A", strtotime($commit['timestamp'])), "value" => $value));
                                }
                                $embed = array(
                                    "author" => array("name" => $sender['login'], "icon_url" => $sender['avatar_url'], "url" => $sender['html_url']),
                                    "title" => "Pushed " . $ccount . " commits to " . $repo['name'],
                                    "type" => "rich",
                                    "url" => $repo['html_url'],
                                    "color" => hexdec("FCA326"),
                                    "timestamp" => date("c"),
                                    "fields" => $fields,
                                    "footer" => array("text" => "Powered by myself")
                                );
                                $this->SendGitEmbed($embed);
                                return response()->json(['success' => true, 'message' => 'Push webhook success'], 200);

                            }
                    }
                }
                return response()->json(['success' => false, 'message' => 'No payload attached'], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
            }
        }
        return response()->json(['success' => false, 'message' =>  "Unauthenticated"], 401);
    }
}
