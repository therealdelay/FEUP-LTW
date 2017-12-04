<div id="user">
  <?php if (isset($_SESSION['username']) && $_SESSION['username'] != '') { ?>
    <form action="logout.php" method="post">
      <a href="profile_page.php"><?=$_SESSION['username']?></a>
      <input type="submit" value="Logout">
    </form>
  <?php } else { ?>
    <form action="login.php" method="post">
      <input type="text" placeholder="username" name="username">
      <input type="password" placeholder="password" name="password">
      <div id="submit_button">
        <input type="button" value="Register" onclick="location.href='templates/common/register_form.php';" />      
        <input type="submit" value="Login">
      </div>
    </form>
  <?php } ?>
</div>