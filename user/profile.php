<?php 
require('../_config.php');
session_start();

if(!isset($_COOKIE['userID'])){
  $user_id = $_COOKIE['userID'];
  header('location:login.php');
};
if(isset($_COOKIE['userID'])){
  $user_id = $_COOKIE['userID'];
};
?>
<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <title>Profile - <?=$websiteTitle?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="title" content="Profile - <?=$websiteTitle?>">
  <meta name="description" content="Anime in HD with No Ads. Watch anime online">
  <meta name="keywords"
    content="<?=$websiteTitle?>, watch anime online, free anime, anime stream, anime hd, english sub, kissanime, gogoanime, animeultima, 9anime, 123animes, <?=$websiteTitle?>, vidstreaming, gogo-stream, animekisa, zoro.to, gogoanime.run, animefrenzy, animekisa">
  <meta name="charset" content="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <meta name="robots" content="noindex, nofollow">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta http-equiv="Content-Language" content="en">
  <meta property="og:title" content="Profile - <?=$websiteTitle?>">
  <meta property="og:description" content="Anime on <?=$websiteTitle?> in HD with No Ads. Watch anime online">
  <meta property="og:locale" content="en_US">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="<?=$websiteTitle?>">
  <meta itemprop="image" content="<?=$banner?>">
  <meta property="og:image" content="<?=$banner?>">
  <link rel="canonical" href="<?=$websiteUrl?>">
  <link rel="alternate" hreflang="en" href="<?=$websiteUrl?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css?v=<?=$version?>" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css?v=<?=$version?>" type="text/css">
 <link rel="shortcut icon" href="<?=$websiteUrl?>/streamable.ico?v=<?=$version?>" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?=$websiteUrl?>/streamable.ico?v=<?=$version?>" />
  <link rel="stylesheet" href="<?=$websiteUrl?>/files/css/style.css?v=<?=$version?>">
    
  <link rel="stylesheet" href="<?=$websiteUrl?>/files/css/min.css?v=<?=$version?>">
  <script type="text/javascript">
    setTimeout(function () {
      var wpse326013 = document.createElement('link');
      wpse326013.rel = 'stylesheet';
      wpse326013.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css?v=<?=$version?>';
      wpse326013.type = 'text/css';
      var godefer = document.getElementsByTagName('link')[0];
      godefer.parentNode.insertBefore(wpse326013, godefer);
      var wpse326013_2 = document.createElement('link');
      wpse326013_2.rel = 'stylesheet';
      wpse326013_2.href = 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css?v=<?=$version?>';
      wpse326013_2.type = 'text/css';
      var godefer2 = document.getElementsByTagName('link')[0];
      godefer2.parentNode.insertBefore(wpse326013_2, godefer2);
    }, 500);
  </script>
  <noscript>
    <link rel="stylesheet" type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css?v=<?=$version?>" />
    <link rel="stylesheet" type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css?v=<?=$version?>" />
  </noscript>
  <scripts></scripts>
  <style> img[src*="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"] { display: none;} </style>
</head>

<body data-page="page_profile">
  <div id="sidebar_menu_bg"></div>
  <div id="wrapper" data-page="page_home">
    <?php include '../_php/header.php'; ?>
    <div class="clearfix"></div>

    <div id="main-wrapper" class="layout-page layout-profile">
      <div class="profile-header">
        <div class="profile-header-cover"
          style="background-image: url(<?php echo $websiteUrl.'/files/avatar/'.$fetch['image'] ?>);"></div>
        <div class="container">
          <div class="ph-title"><?=$fetch['name']?></div>
          <div class="ph-tabs">
            <div class="bah-tabs">
              <ul class="nav nav-tabs pre-tabs">
                <li class="nav-item"><a class="nav-link active" href="<?=$websiteUrl?>/user/profile"><i
                      class="fas fa-user mr-2"></i>Profile</a></li>
                <li class="nav-item"><a class="nav-link " href="<?=$websiteUrl?>/user/continue-watching"><i class="fas fa-history mr-2"></i>Continue Watching</a></li>
                <li class="nav-item"><a class="nav-link " href="<?=$websiteUrl?>/user/watchlist"><i class="fas fa-heart mr-2"></i>Watch List</a></li>
                <li class="nav-item"><a class="nav-link" href="<?=$websiteUrl?>/user/changepass"><i class="fas fa-key mr-2"></i>Change
                    Password</a></li>
              </ul>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
      <div class="profile-content">
        <div class="container">
          <div class="profile-box profile-box-account makeup">
            <h2 class="h2-heading mb-4"><i class="fas fa-user mr-3"></i>Your Profile</h2>
            <div class="block_area-content">
              <div class="show-profile-avatar text-center mb-3">
                <div class="profile-avatar d-inline-block" data-toggle="modal" data-target="#modalavatars">
                     <div class="pa-edit"><i class="fas fa-pen"></i></div>
                  <?php
                   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
                   if(mysqli_num_rows($select) > 0){
                      $fetch = mysqli_fetch_assoc($select);
                   }
                  if($fetch['image'] == ''){
   echo '<img id="preview-avatar" src="'.$websiteUrl.'/files/avatar/default/default.jpeg">';
}else{
   echo '<img id="preview-avatar" src="'.$websiteUrl.'/files/avatar/'.$fetch['image'].'">';
}?>
                </div>
              </div>
              <form class="preform" method="post" id="profile-form">
                <input type="hidden" name="avatar_id" value="1">
                <div class="row">
                  <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="form-group">
                      <label class="prelabel" for="pro5-email">Email address</label>
                      <input type="email" name="email" class="form-control" disabled id="pro5-email"
                        value="<?php echo $fetch['email']; ?>">
                    </div>
                  </div>
                  <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="form-group">
                      <label class="prelabel" for="pro5-name">Username</label>
                      <input type="text" class="form-control" disabled id="pro5-name" name="name" required
                        value="<?php echo $fetch['name']; ?>">
                    </div>
                  </div>
                  <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="form-group">
                      <label class="prelabel" for="pro5-join">Joined</label>
                      <input type="text" class="form-control" disabled id="pro5-join" value="<?php echo $fetch['date']; ?>">
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
        
<div class="modal fade premodal premodal-avatars" id="modalavatars" tabindex="-1" role="dialog" aria-labelledby="modalcharacterstitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Choose Avatar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
<div class="modal-body">
    <ul class="nav nav-tabs pre-tabs pre-tabs-min pre-tabs-hashtag" style="margin-top: -5px">
        <li class="nav-item">
            <a data-toggle="tab" href="#hashtag-1" class="nav-link">#Chainsaw Man</a>
            <a data-toggle="tab" href="#hashtag-2" class="nav-link">#Chibi</a>
            <a data-toggle="tab" href="#hashtag-3" class="nav-link">#DemonSlayer</a>
            <a data-toggle="tab" href="#hashtag-4" class="nav-link">#Dragonball</a>
            <a data-toggle="tab" href="#hashtag-5" class="nav-link">#Jujutsu Kaisen</a>
            <a data-toggle="tab" href="#hashtag-6" class="nav-link">#Naruto</a>
            <a data-toggle="tab" href="#hashtag-7" class="nav-link">#Onepiece</a>
            <a data-toggle="tab" href="#hashtag-8" class="nav-link">#Others</a>
              <a data-toggle="tab" href="#hashtag-9" class="nav-link">#Special</a>
        </li>
    </ul>
</div>

<div class="tab-content">
    <div id="hashtag-1" class="tab-pane fade">
        <div class="avatar-list">
            <script>
                // JavaScript code to dynamically generate avatars
                var avatarFolder = "../files/categories/chainsaw/"; // Folder path where avatars are stored
                var avatarCount = 31; // Number of avatars

                var avatarList = document.querySelector("#hashtag-1 .avatar-list"); // Get avatar list for hashtag-1

                for (var i = 23; i <= avatarCount; i++) {
                    var itemId = "avatar-item-" + i;
                    var dataId = "user-" + i + ".jpeg";
                    var imgSrc = avatarFolder + "user-" + i + ".jpeg";

                    var avatarItem = document.createElement("div");
                    avatarItem.classList.add("item", "item-avatar");
                    avatarItem.setAttribute("data-id", dataId);

                    var checkedDiv = document.createElement("div");
                    checkedDiv.classList.add("checked");
                    checkedDiv.innerHTML = '<i class="fas fa-check"></i>';
                    avatarItem.appendChild(checkedDiv);

                    var profileAvatar = document.createElement("div");
                    profileAvatar.classList.add("profile-avatar");

                    var avatarImg = document.createElement("img");
                    avatarImg.setAttribute("src", imgSrc);
                    profileAvatar.appendChild(avatarImg);

                    avatarItem.appendChild(profileAvatar);
                    avatarList.appendChild(avatarItem);

                    avatarItem.addEventListener("click", function() {
                        var clickedAvatar = this;
                        var dataId = clickedAvatar.getAttribute("data-id");
                        console.log("Clicked avatar dataId:", dataId);

                        // Remove checkmark from all avatars
                        var allAvatars = document.querySelectorAll(".item-avatar");
                        allAvatars.forEach(function(avatar) {
                            avatar.classList.remove("active");
                        });

                        // Add checkmark to the clicked avatar
                        clickedAvatar.classList.add("active");

                        // Update image in the database using AJAX
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "ajax/update_avatar.php", true);
                        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === XMLHttpRequest.DONE) {
                                if (xhr.status === 200) {
                                    console.log("Image updated successfully");
                                    // Close the modal
                                    $('#modalavatars').modal('hide');
                                    // Update the image
                                    var imageElement = document.querySelector("#preview-avatar");
                                    imageElement.setAttribute("src", clickedAvatar.querySelector("img").getAttribute("src"));
                                } else {
                                    console.log("Image update failed");
                                }
                            }
                        };
                        xhr.send("dataId=" + encodeURIComponent(dataId));
                    });
                }
            </script>
        </div>
    </div>
        <div id="hashtag-2" class="tab-pane fade">
        <div class="avatar-list">
            <script>
                // JavaScript code to dynamically generate avatars
                var avatarFolder = "../files/categories/chibi/"; // Folder path where avatars are stored
                var avatarCount = 70; // Number of avatars

                var avatarList = document.querySelector("#hashtag-2 .avatar-list"); // Get avatar list for hashtag-1

                for (var i = 32; i <= avatarCount; i++) {
                    var itemId = "avatar-item-" + i;
                    var dataId = "user-" + i + ".jpeg";
                    var imgSrc = avatarFolder + "user-" + i + ".jpeg";

                    var avatarItem = document.createElement("div");
                    avatarItem.classList.add("item", "item-avatar");
                    avatarItem.setAttribute("data-id", dataId);

                    var checkedDiv = document.createElement("div");
                    checkedDiv.classList.add("checked");
                    checkedDiv.innerHTML = '<i class="fas fa-check"></i>';
                    avatarItem.appendChild(checkedDiv);

                    var profileAvatar = document.createElement("div");
                    profileAvatar.classList.add("profile-avatar");

                    var avatarImg = document.createElement("img");
                    avatarImg.setAttribute("src", imgSrc);
                    profileAvatar.appendChild(avatarImg);

                    avatarItem.appendChild(profileAvatar);
                    avatarList.appendChild(avatarItem);

                    avatarItem.addEventListener("click", function() {
                        var clickedAvatar = this;
                        var dataId = clickedAvatar.getAttribute("data-id");
                        console.log("Clicked avatar dataId:", dataId);

                        // Remove checkmark from all avatars
                        var allAvatars = document.querySelectorAll(".item-avatar");
                        allAvatars.forEach(function(avatar) {
                            avatar.classList.remove("active");
                        });

                        // Add checkmark to the clicked avatar
                        clickedAvatar.classList.add("active");

                        // Update image in the database using AJAX
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "ajax/update_avatar.php", true);
                        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === XMLHttpRequest.DONE) {
                                if (xhr.status === 200) {
                                    console.log("Image updated successfully");
                                    // Close the modal
                                    $('#modalavatars').modal('hide');
                                    // Update the image
                                    var imageElement = document.querySelector("#preview-avatar");
                                    imageElement.setAttribute("src", clickedAvatar.querySelector("img").getAttribute("src"));
                                } else {
                                    console.log("Image update failed");
                                }
                            }
                        };
                        xhr.send("dataId=" + encodeURIComponent(dataId));
                    });
                }
            </script>
        </div>
    </div>
        <div id="hashtag-3" class="tab-pane fade">
        <div class="avatar-list">
            <script>
                // JavaScript code to dynamically generate avatars
                var avatarFolder = "../files/categories/DemonSlayer/"; // Folder path where avatars are stored
                var avatarCount = 90; // Number of avatars

                var avatarList = document.querySelector("#hashtag-3 .avatar-list"); // Get avatar list for hashtag-1

                for (var i = 71; i <= avatarCount; i++) {
                    var itemId = "avatar-item-" + i;
                    var dataId = "user-" + i + ".jpeg";
                    var imgSrc = avatarFolder + "user-" + i + ".jpeg";

                    var avatarItem = document.createElement("div");
                    avatarItem.classList.add("item", "item-avatar");
                    avatarItem.setAttribute("data-id", dataId);

                    var checkedDiv = document.createElement("div");
                    checkedDiv.classList.add("checked");
                    checkedDiv.innerHTML = '<i class="fas fa-check"></i>';
                    avatarItem.appendChild(checkedDiv);

                    var profileAvatar = document.createElement("div");
                    profileAvatar.classList.add("profile-avatar");

                    var avatarImg = document.createElement("img");
                    avatarImg.setAttribute("src", imgSrc);
                    profileAvatar.appendChild(avatarImg);

                    avatarItem.appendChild(profileAvatar);
                    avatarList.appendChild(avatarItem);

                    avatarItem.addEventListener("click", function() {
                        var clickedAvatar = this;
                        var dataId = clickedAvatar.getAttribute("data-id");
                        console.log("Clicked avatar dataId:", dataId);

                        // Remove checkmark from all avatars
                        var allAvatars = document.querySelectorAll(".item-avatar");
                        allAvatars.forEach(function(avatar) {
                            avatar.classList.remove("active");
                        });

                        // Add checkmark to the clicked avatar
                        clickedAvatar.classList.add("active");

                        // Update image in the database using AJAX
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "ajax/update_avatar.php", true);
                        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === XMLHttpRequest.DONE) {
                                if (xhr.status === 200) {
                                    console.log("Image updated successfully");
                                    // Close the modal
                                    $('#modalavatars').modal('hide');
                                    // Update the image
                                    var imageElement = document.querySelector("#preview-avatar");
                                    imageElement.setAttribute("src", clickedAvatar.querySelector("img").getAttribute("src"));
                                } else {
                                    console.log("Image update failed");
                                }
                            }
                        };
                        xhr.send("dataId=" + encodeURIComponent(dataId));
                    });
                }
            </script>
        </div>
    </div>
       <div id="hashtag-4" class="tab-pane fade">
        <div class="avatar-list">
            <script>
                // JavaScript code to dynamically generate avatars
                var avatarFolder = "../files/categories/Dragonball/"; // Folder path where avatars are stored
                var avatarCount = 97; // Number of avatars

                var avatarList = document.querySelector("#hashtag-4 .avatar-list"); // Get avatar list for hashtag-1

                for (var i = 91; i <= avatarCount; i++) {
                    var itemId = "avatar-item-" + i;
                    var dataId = "user-" + i + ".jpeg";
                    var imgSrc = avatarFolder + "user-" + i + ".jpeg";

                    var avatarItem = document.createElement("div");
                    avatarItem.classList.add("item", "item-avatar");
                    avatarItem.setAttribute("data-id", dataId);

                    var checkedDiv = document.createElement("div");
                    checkedDiv.classList.add("checked");
                    checkedDiv.innerHTML = '<i class="fas fa-check"></i>';
                    avatarItem.appendChild(checkedDiv);

                    var profileAvatar = document.createElement("div");
                    profileAvatar.classList.add("profile-avatar");

                    var avatarImg = document.createElement("img");
                    avatarImg.setAttribute("src", imgSrc);
                    profileAvatar.appendChild(avatarImg);

                    avatarItem.appendChild(profileAvatar);
                    avatarList.appendChild(avatarItem);

                    avatarItem.addEventListener("click", function() {
                        var clickedAvatar = this;
                        var dataId = clickedAvatar.getAttribute("data-id");
                        console.log("Clicked avatar dataId:", dataId);

                        // Remove checkmark from all avatars
                        var allAvatars = document.querySelectorAll(".item-avatar");
                        allAvatars.forEach(function(avatar) {
                            avatar.classList.remove("active");
                        });

                        // Add checkmark to the clicked avatar
                        clickedAvatar.classList.add("active");

                        // Update image in the database using AJAX
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "ajax/update_avatar.php", true);
                        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === XMLHttpRequest.DONE) {
                                if (xhr.status === 200) {
                                    console.log("Image updated successfully");
                                    // Close the modal
                                    $('#modalavatars').modal('hide');
                                    // Update the image
                                    var imageElement = document.querySelector("#preview-avatar");
                                    imageElement.setAttribute("src", clickedAvatar.querySelector("img").getAttribute("src"));
                                } else {
                                    console.log("Image update failed");
                                }
                            }
                        };
                        xhr.send("dataId=" + encodeURIComponent(dataId));
                    });
                }
            </script>
        </div>
    </div>
        <div id="hashtag-5" class="tab-pane fade">
        <div class="avatar-list">
            <script>
                // JavaScript code to dynamically generate avatars
                var avatarFolder = "../files/categories/Jujutsu/"; // Folder path where avatars are stored
                var avatarCount = 111; // Number of avatars

                var avatarList = document.querySelector("#hashtag-5 .avatar-list"); // Get avatar list for hashtag-1

                for (var i = 98; i <= avatarCount; i++) {
                    var itemId = "avatar-item-" + i;
                    var dataId = "user-" + i + ".jpeg";
                    var imgSrc = avatarFolder + "user-" + i + ".jpeg";

                    var avatarItem = document.createElement("div");
                    avatarItem.classList.add("item", "item-avatar");
                    avatarItem.setAttribute("data-id", dataId);

                    var checkedDiv = document.createElement("div");
                    checkedDiv.classList.add("checked");
                    checkedDiv.innerHTML = '<i class="fas fa-check"></i>';
                    avatarItem.appendChild(checkedDiv);

                    var profileAvatar = document.createElement("div");
                    profileAvatar.classList.add("profile-avatar");

                    var avatarImg = document.createElement("img");
                    avatarImg.setAttribute("src", imgSrc);
                    profileAvatar.appendChild(avatarImg);

                    avatarItem.appendChild(profileAvatar);
                    avatarList.appendChild(avatarItem);

                    avatarItem.addEventListener("click", function() {
                        var clickedAvatar = this;
                        var dataId = clickedAvatar.getAttribute("data-id");
                        console.log("Clicked avatar dataId:", dataId);

                        // Remove checkmark from all avatars
                        var allAvatars = document.querySelectorAll(".item-avatar");
                        allAvatars.forEach(function(avatar) {
                            avatar.classList.remove("active");
                        });

                        // Add checkmark to the clicked avatar
                        clickedAvatar.classList.add("active");

                        // Update image in the database using AJAX
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "ajax/update_avatar.php", true);
                        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === XMLHttpRequest.DONE) {
                                if (xhr.status === 200) {
                                    console.log("Image updated successfully");
                                    // Close the modal
                                    $('#modalavatars').modal('hide');
                                    // Update the image
                                    var imageElement = document.querySelector("#preview-avatar");
                                    imageElement.setAttribute("src", clickedAvatar.querySelector("img").getAttribute("src"));
                                } else {
                                    console.log("Image update failed");
                                }
                            }
                        };
                        xhr.send("dataId=" + encodeURIComponent(dataId));
                    });
                }
            </script>
        </div>
    </div>
        <div id="hashtag-6" class="tab-pane fade">
        <div class="avatar-list">
            <script>
                // JavaScript code to dynamically generate avatars
                var avatarFolder = "../files/categories/Naruto/"; // Folder path where avatars are stored
                var avatarCount =119; // Number of avatars

                var avatarList = document.querySelector("#hashtag-6 .avatar-list"); // Get avatar list for hashtag-1

                for (var i = 112; i <= avatarCount; i++) {
                    var itemId = "avatar-item-" + i;
                    var dataId = "user-" + i + ".jpeg";
                    var imgSrc = avatarFolder + "user-" + i + ".jpeg";

                    var avatarItem = document.createElement("div");
                    avatarItem.classList.add("item", "item-avatar");
                    avatarItem.setAttribute("data-id", dataId);

                    var checkedDiv = document.createElement("div");
                    checkedDiv.classList.add("checked");
                    checkedDiv.innerHTML = '<i class="fas fa-check"></i>';
                    avatarItem.appendChild(checkedDiv);

                    var profileAvatar = document.createElement("div");
                    profileAvatar.classList.add("profile-avatar");

                    var avatarImg = document.createElement("img");
                    avatarImg.setAttribute("src", imgSrc);
                    profileAvatar.appendChild(avatarImg);

                    avatarItem.appendChild(profileAvatar);
                    avatarList.appendChild(avatarItem);

                    avatarItem.addEventListener("click", function() {
                        var clickedAvatar = this;
                        var dataId = clickedAvatar.getAttribute("data-id");
                        console.log("Clicked avatar dataId:", dataId);

                        // Remove checkmark from all avatars
                        var allAvatars = document.querySelectorAll(".item-avatar");
                        allAvatars.forEach(function(avatar) {
                            avatar.classList.remove("active");
                        });

                        // Add checkmark to the clicked avatar
                        clickedAvatar.classList.add("active");

                        // Update image in the database using AJAX
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "ajax/update_avatar.php", true);
                        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === XMLHttpRequest.DONE) {
                                if (xhr.status === 200) {
                                    console.log("Image updated successfully");
                                    // Close the modal
                                    $('#modalavatars').modal('hide');
                                    // Update the image
                                    var imageElement = document.querySelector("#preview-avatar");
                                    imageElement.setAttribute("src", clickedAvatar.querySelector("img").getAttribute("src"));
                                } else {
                                    console.log("Image update failed");
                                }
                            }
                        };
                        xhr.send("dataId=" + encodeURIComponent(dataId));
                    });
                }
            </script>
        </div>
    </div>
        <div id="hashtag-7" class="tab-pane fade">
        <div class="avatar-list">
            <script>
                // JavaScript code to dynamically generate avatars
                var avatarFolder = "../files/categories/Onepiece/"; // Folder path where avatars are stored
                var avatarCount = 140; // Number of avatars

                var avatarList = document.querySelector("#hashtag-7 .avatar-list"); // Get avatar list for hashtag-1

                for (var i = 120; i <= avatarCount; i++) {
                    var itemId = "avatar-item-" + i;
                    var dataId = "user-" + i + ".jpeg";
                    var imgSrc = avatarFolder + "user-" + i + ".jpeg";

                    var avatarItem = document.createElement("div");
                    avatarItem.classList.add("item", "item-avatar");
                    avatarItem.setAttribute("data-id", dataId);

                    var checkedDiv = document.createElement("div");
                    checkedDiv.classList.add("checked");
                    checkedDiv.innerHTML = '<i class="fas fa-check"></i>';
                    avatarItem.appendChild(checkedDiv);

                    var profileAvatar = document.createElement("div");
                    profileAvatar.classList.add("profile-avatar");

                    var avatarImg = document.createElement("img");
                    avatarImg.setAttribute("src", imgSrc);
                    profileAvatar.appendChild(avatarImg);

                    avatarItem.appendChild(profileAvatar);
                    avatarList.appendChild(avatarItem);

                    avatarItem.addEventListener("click", function() {
                        var clickedAvatar = this;
                        var dataId = clickedAvatar.getAttribute("data-id");
                        console.log("Clicked avatar dataId:", dataId);

                        // Remove checkmark from all avatars
                        var allAvatars = document.querySelectorAll(".item-avatar");
                        allAvatars.forEach(function(avatar) {
                            avatar.classList.remove("active");
                        });

                        // Add checkmark to the clicked avatar
                        clickedAvatar.classList.add("active");

                        // Update image in the database using AJAX
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "ajax/update_avatar.php", true);
                        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === XMLHttpRequest.DONE) {
                                if (xhr.status === 200) {
                                    console.log("Image updated successfully");
                                    // Close the modal
                                    $('#modalavatars').modal('hide');
                                    // Update the image
                                    var imageElement = document.querySelector("#preview-avatar");
                                    imageElement.setAttribute("src", clickedAvatar.querySelector("img").getAttribute("src"));
                                } else {
                                    console.log("Image update failed");
                                }
                            }
                        };
                        xhr.send("dataId=" + encodeURIComponent(dataId));
                    });
                }
            </script>
        </div>
    </div>
        <div id="hashtag-8" class="tab-pane fade">
        <div class="avatar-list">
            <script>
                // JavaScript code to dynamically generate avatars
                var avatarFolder = "../files/categories/avatar/"; // Folder path where avatars are stored
                var avatarCount = 22; // Number of avatars

                var avatarList = document.querySelector("#hashtag-8 .avatar-list"); // Get avatar list for hashtag-1

                for (var i = 1; i <= avatarCount; i++) {
                    var itemId = "avatar-item-" + i;
                    var dataId = "user-" + i + ".jpeg";
                    var imgSrc = avatarFolder + "user-" + i + ".jpeg";

                    var avatarItem = document.createElement("div");
                    avatarItem.classList.add("item", "item-avatar");
                    avatarItem.setAttribute("data-id", dataId);

                    var checkedDiv = document.createElement("div");
                    checkedDiv.classList.add("checked");
                    checkedDiv.innerHTML = '<i class="fas fa-check"></i>';
                    avatarItem.appendChild(checkedDiv);

                    var profileAvatar = document.createElement("div");
                    profileAvatar.classList.add("profile-avatar");

                    var avatarImg = document.createElement("img");
                    avatarImg.setAttribute("src", imgSrc);
                    profileAvatar.appendChild(avatarImg);

                    avatarItem.appendChild(profileAvatar);
                    avatarList.appendChild(avatarItem);

                    avatarItem.addEventListener("click", function() {
                        var clickedAvatar = this;
                        var dataId = clickedAvatar.getAttribute("data-id");
                        console.log("Clicked avatar dataId:", dataId);

                        // Remove checkmark from all avatars
                        var allAvatars = document.querySelectorAll(".item-avatar");
                        allAvatars.forEach(function(avatar) {
                            avatar.classList.remove("active");
                        });

                        // Add checkmark to the clicked avatar
                        clickedAvatar.classList.add("active");

                        // Update image in the database using AJAX
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "ajax/update_avatar.php", true);
                        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === XMLHttpRequest.DONE) {
                                if (xhr.status === 200) {
                                    console.log("Image updated successfully");
                                    // Close the modal
                                    $('#modalavatars').modal('hide');
                                    // Update the image
                                    var imageElement = document.querySelector("#preview-avatar");
                                    imageElement.setAttribute("src", clickedAvatar.querySelector("img").getAttribute("src"));
                                } else {
                                    console.log("Image update failed");
                                }
                            }
                        };
                        xhr.send("dataId=" + encodeURIComponent(dataId));
                    });
                }
            </script>
        </div>
    </div>
    <div id="hashtag-9" class="tab-pane fade">

        <div class="avatar-list">

            <script>
                // JavaScript code to dynamically generate avatars
                var avatarFolder = "../files/categories/Exclusive/"; // Folder path where avatars are stored
                var avatarCount = 190; // Number of avatars

                var avatarList = document.querySelector("#hashtag-9 .avatar-list"); // Get avatar list for hashtag-1

                for (var i = 141; i <= avatarCount; i++) {
                    var itemId = "avatar-item-" + i;
                    var dataId = "user-" + i + ".jpeg";
                    var imgSrc = avatarFolder + "user-" + i + ".jpeg";

                    var avatarItem = document.createElement("div");
                    avatarItem.classList.add("item", "item-avatar");
                    avatarItem.setAttribute("data-id", dataId);

                    var checkedDiv = document.createElement("div");
                    checkedDiv.classList.add("checked");
                    checkedDiv.innerHTML = '<i class="fas fa-check"></i>';
                    avatarItem.appendChild(checkedDiv);

                    var profileAvatar = document.createElement("div");
                    profileAvatar.classList.add("profile-avatar");

                    var avatarImg = document.createElement("img");
                    avatarImg.setAttribute("src", imgSrc);
                    profileAvatar.appendChild(avatarImg);

                    avatarItem.appendChild(profileAvatar);
                    avatarList.appendChild(avatarItem);

                    avatarItem.addEventListener("click", function() {
                        var clickedAvatar = this;
                        var dataId = clickedAvatar.getAttribute("data-id");
                        console.log("Clicked avatar dataId:", dataId);

                        // Remove checkmark from all avatars
                        var allAvatars = document.querySelectorAll(".item-avatar");
                        allAvatars.forEach(function(avatar) {
                            avatar.classList.remove("active");
                        });

                        // Add checkmark to the clicked avatar
                        clickedAvatar.classList.add("active");

                        // Update image in the database using AJAX
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "ajax/update_avatar.php", true);
                        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === XMLHttpRequest.DONE) {
                                if (xhr.status === 200) {
                                    console.log("Image updated successfully");
                                    // Close the modal
                                    $('#modalavatars').modal('hide');
                                    // Update the image
                                    var imageElement = document.querySelector("#preview-avatar");
                                    imageElement.setAttribute("src", clickedAvatar.querySelector("img").getAttribute("src"));
                                } else {
                                    console.log("Image update failed");
                                }
                            }
                        };
                        xhr.send("dataId=" + encodeURIComponent(dataId));
                    });
                }
            </script>
        </div>
    </div>
    <!-- Add other hashtag-2, hashtag-3, ... sections with similar code for other hashtags -->
    

</div>

        </div>
    </div>
</div>

    <?php include '../_php/footer.php' ?>
    <div id="mask-overlay"></div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js?v=<?=$version?>"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js?v=<?=$version?>"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
    <script type="text/javascript" src="<?=$websiteUrl?>/files/js/app.js?v=<?=$version?>"></script>
    <script type="text/javascript" src="<?=$websiteUrl?>/files/js/comman.js?v=<?=$version?>"></script>
    <script type="text/javascript" src="<?=$websiteUrl?>/files/js/movie.js?v=<?=$version?>"></script>
    <link rel="stylesheet" href="<?=$websiteUrl?>/files/css/jquery-ui.css?v=<?=$version?>">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js?v=<?=$version?>"></script>
    <script type="text/javascript" src="<?=$websiteUrl?>/files/js/function.js?v=<?=$version?>"></script>
    <div style="display:none;">
    </div>
  </div>
</body>

</html>