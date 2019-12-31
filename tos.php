<!DOCTYPE html>
<?php
require('steamauth/steamauth.php');  
include("databases/connect.php");

include("navbar.php");
$privacypolicyquery = SQLWrapper()->prepare("SELECT content,title,privacy,description,UNIX_TIMESTAMP(stamp) AS stamp FROM content WHERE thing = :thing");
$privacypolicyquery->execute([':thing' => 'tos']);
$content = $privacypolicyquery->fetch();
$plastupdated = date("m/d/Y g:i a", $content["stamp"]);
$privacy = $content['privacy'];
$title = $content['title'];
$description = $content['description'];
$notloggedin = false;
$notdiscord = false;
$noperms = false;
if($privacy === "0"){//Public
    $showpage = true;
}elseif($privacy === "1"){//MUst be Loggedin

        if(isset($_SESSION['steamid'])){ 
            $showpage = true; 
        }else{
            $showpage = false;
            $notloggedin = true;
        }
}elseif($privacy === "2"){// Must be Diwscord
    if(isset($_SESSION['steamid'])){    
        if(isVerified($_SESSION['steamid'])){
            $showpage = true;    
        }else{
            $showpage = false;
            $notdiscord = true;
        } 
    }else{
        $showpage = false;
        $notloggedin = true;
    }
    
}elseif($privacy === "3"){  //Must be admin
    if(isset($_SESSION['steamid'])){    
        if(isAdmin($_SESSION['steamid'])){
            $showpage = true;    
        }else{
            $showpage = false;
            $noperms  = true;
        } 
    }else{
        $showpage = false;
        $notloggedin = true;
    }
}elseif($privacy === "4"){  //Must be admin
    if(isset($_SESSION['steamid'])){    
        if(isMasterAdmin($_SESSION['steamid'])){
            $showpage = true;    
        }else{
            $showpage = false;
            $noperms  = true;
        } 
    }else{
        $showpage = false;
        $notloggedin = true;
    }
}
?>



<html>
    <head>
        <meta name="description" content="<?=htmlspecialchars($description);?>">
        <meta name="keywords" content="privacy policy, driedsponge.net privacy, driedsponge.net privacy policy">
        <meta name="author" content="Jordan Tucker">
        <meta property="og:site_name" content="DriedSponge.net | <?=htmlspecialchars($title);?>" />
       
        <?php 
            include("meta.php"); 
            ?>
        
        <title><?=htmlspecialchars($title);?></title>
        <script src="https://kit.fontawesome.com/0add82e87e.js" crossorigin="anonymous"></script>
    </head>
 <body>


    <div class="app">
    <div class="container-fluid-lg" style="padding-top: 70px;">
        <div class="container">
        <?php
        if($showpage){
        ?>
                <hgroup>
                        <!-- <img src="https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/18/18be38c2f230fea0fa667c8165e4da5cb1a787c0_full.jpg" alt="DriedSponge's Profile Picture"> -->
                        <h1 class="display-2"><strong><?=htmlspecialchars($title);?></strong></h1>   
                </hgroup>
                <br>
                   <?=htmlspecialchars_decode($content['content']);?>
                    <br>
                    
                    <?php
                    }
                    if ($notloggedin) {
                    ?>
                    <h1 class="articleh1">Please login to view this page</h1>
                    <br>
                    <p class="text-center"><a href='?login'><img src='https://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_02.png'></a></p>
                    <?php
                    }
                    if ($notdiscord) {
                    ?>
                    <h1 class="articleh1">You must be in the discord and verified to view this page. If you are not in it, you can click <a href="https://discordapp.com/invite/YS4WZWG" target="_blank">here</a> to join. If you are in the discord, head into the bot commands channel and do <strong>!verify</strong> to get started.</h1>
                    <?php
                    }
                    if($noperms){
                        ?>
                        <h1 class="articleh1">You do not have the proper perms to access this page.</h1>
                        <?php
                    }
                    ?>
                
            </div>
                
                </div>
                
            </div>
            
            <!-- end of app -->
            <?php 
            include("footer.php"); // we include footer.php here. you can use .html extension, too.
            ?>
                
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                <script src="https://unpkg.com/popper.js@1"></script>
                <script src="https://unpkg.com/tippy.js@4"></script>
                <script src="main.js"></script>
              
 </body>






</html>