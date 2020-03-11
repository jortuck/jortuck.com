<?php
if(isset($_SESSION['steamid'])){

  
  if(isset($_POST['unverify'])){
    header('Content-type: application/json');

    $Message = array(
      "success" => false,
      "message" => "Something went wrong"
    );
    if(isAdmin($_SESSION['steamid'])){
    $unverifyid = $_POST['discordid'];
    $username = $_POST['username'];
    $sql = SQLWrapper()->prepare("UPDATE discord SET verifyid = :vid WHERE discordid= :id");
    $sql->execute([':id' => $unverifyid, ':vid' => "UNVERIFIED"]);
    $Message = array(
      "success" => true,
      "message" => "$username has been unverified!"
    );
    }else{
      $Message["message"] = "Not an admin";
    }
die(json_encode($Message));
  }


if(isset($_POST['submit']) and isset($_POST['method']) and $_POST['method'] === "jQuery"){
  if(isAdmin($_SESSION['steamid'])){
    $steamidgood = false;
    $discordtaggood = false;
    $discordidgood = false;
        $verifysteamid = $_POST['id64'];
        $discordtag =$_POST['tag'];
        $discordid = $_POST['discordid'];
        $method = $_POST['method'];

        if(IsEmpty($verifysteamid)){
          ?>
            <script>
              $("#verify-id64").addClass("is-invalid");
              $("#verify-id64-feedback").addClass("invalid-feedback");
              document.getElementById("verify-id64-feedback").innerHTML = "Please fill something in";
            </script>
          <?php
          }else if(!is_numeric($verifysteamid)){
            ?>
            <script>
              $("#verify-id64").addClass("is-invalid");
              $("#verify-id64-feedback").addClass("invalid-feedback");
              document.getElementById("verify-id64-feedback").innerHTML = "SteamID64's are numbers only";
            </script>
            <?php
          }else if(!IsEmpty($verifysteamid) && is_numeric($verifysteamid)){
            $steamidgood = true;
            ?>
            <script>
              $("#verify-id64").removeClass("is-invalid");
              $("#verify-id64").addClass("is-valid");
              $("#verify-id64-feedback").removeClass("invalid-feedback");
              $("#verify-id64-feedback").addClass("valid-feedback");
              document.getElementById("verify-id64-feedback").innerHTML = "Looks good!";
            </script>
            <?php
          }
          if(IsEmpty($discordtag)){
            ?>
              <script>
                $("#verify-discordtag").addClass("is-invalid");
                $("#verify-discordtag-feedback").addClass("invalid-feedback");
                document.getElementById("verify-discordtag-feedback").innerHTML = "Please fill something in";
              </script>
            <?php
            }else if(!preg_match("/.*#[0-9]{4}/",$discordtag)){
              ?>
              <script>
                $("#verify-discordtag").addClass("is-invalid");
                $("#verify-discordtag-feedback").addClass("invalid-feedback");
                document.getElementById("verify-discordtag-feedback").innerHTML = "Your input does not match the format of a discord username and tag. ex: DriedSponge#0001";
              </script>
              <?php
            }else if(!IsEmpty($discordtag) && preg_match("/.*#[0-9]{4}/",$discordtag)){
              $discordtaggood = true;
              ?>
              <script>
                $("#verify-discordtag").removeClass("is-invalid");
                $("#verify-discordtag").addClass("is-valid");
                $("#verify-discordtag-feedback").removeClass("invalid-feedback");
                $("#verify-discordtag-feedback").addClass("valid-feedback");
                document.getElementById("verify-discordtag-feedback").innerHTML = "Looks good!";
              </script>
              <?php
            }
            if(IsEmpty($discordid)){
              ?>
                <script>
                  $("#verify-discordid").addClass("is-invalid");
                  $("#verify-discordid-feedback").addClass("invalid-feedback");
                  document.getElementById("verify-discordid-feedback").innerHTML = "Please fill something in";
                </script>
              <?php
              }else if(!is_numeric($discordid)){
                ?>
                <script>
                  $("#verify-discordid").addClass("is-invalid");
                  $("#verify-discordid-feedback").addClass("invalid-feedback");
                  document.getElementById("verify-discordid-feedback").innerHTML = "The Discord ID has to be a number!";
                </script>
                <?php
              }else if(!IsEmpty($discordid) && is_numeric($discordid)){
                $discordidgood = true;
                ?>
                <script>
                  $("#verify-discordid").removeClass("is-invalid");
                  $("#verify-discordid").addClass("is-valid");
                  $("#verify-discordid-feedback").removeClass("invalid-feedback");
                  $("#verify-discordid-feedback").addClass("valid-feedback");
                  document.getElementById("verify-discordid-feedback").innerHTML = "Looks good!";
                </script>
                <?php
              }
              if($discordtaggood && $steamidgood && $discordidgood){

                  $verifyid = "VERIFIED";
                  $verifytime = time();
                  $alreadyverified = SQLWrapper()->prepare("SELECT steamid FROM discord WHERE steamid= :id");
                  $alreadyverified->execute([':id' => $verifysteamid]);
                  $alreadyverifiedrows = $alreadyverified->fetch();
                  if (!IsEmpty($alreadyverifiedrows)){
                    ?>
                    <script>
                    toastr["error"]("This user is already verified!", "Error:")   
                    </script>
                  <?php  
                  } else{

                    $sqlblock = SQLWrapper()->prepare("INSERT INTO discord (discordid,steamid, stamp, verifyid,discorduser,givenrole)
                    VALUES (?,?,?,?,?,?)")->execute([$discordid,$verifysteamid,$verifytime,$verifyid,$discordtag,0]);
                    ?>
                        <script>
                          $("#verify-discord")[0].reset();
                        toastr["success"]("<?=htmlspecialchars($discordtag);?> has been verified!", "Congratulations!")   
                        </script>
                    <?php
                  }


              }

    }else  {
      ?>
      <script>
        toastr["error"]("Not authorized", "Error:")   
      </script>
      <?php
    }
  }


}else{
  ?>
  <script>
    toastr["error"]("Not logged in", "Error:")   
  </script>
  <?php
}
?>