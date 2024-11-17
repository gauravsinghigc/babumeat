<?php
//login per details
if (isset($_SESSION['LOGIN_USER_ID'])) {
 define("LOGIN_UserId", $_SESSION['LOGIN_USER_ID']);
 define("LOGIN_UserName", FETCH("SELECT * FROM users where UserId='" . LOGIN_UserId . "'", "UserName"));
 define("LOGIN_UserEmailId", FETCH("SELECT * FROM users where UserId='" . LOGIN_UserId . "'", "UserEmailId"));
 define("LOGIN_UserPassword", FETCH("SELECT * FROM users where UserId='" . LOGIN_UserId . "'", "UserPassword"));
 define("LOGIN_UserPhone", FETCH("SELECT * FROM users where UserId='" . LOGIN_UserId . "'", "UserPhone"));
 define("LOGIN_UserRoles", FETCH("SELECT * FROM users where UserId='" . LOGIN_UserId . "'", "UserRoles"));
 define("LOGIN_UserStatus", FETCH("SELECT * FROM users where UserId='" . LOGIN_UserId . "'", "UserStatus"));
 define("LOGIN_UserCreatedAt", FETCH("SELECT * FROM users where UserId='" . LOGIN_UserId . "'", "UserCreatedAt"));
 define("LOGIN_UserUpdatedAt", FETCH("SELECT * FROM users where UserId='" . LOGIN_UserId . "'", "UserUpdatedAt"));
 define("LOGIN_UserProfileImage", FETCH("SELECT * FROM users where UserId='" . LOGIN_UserId . "'", "UserProfileImage"));
}
