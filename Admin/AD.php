<?php
session_start();
if (
    isset($_SESSION['studentId']) &&
    isset($_SESSION['studentName']) &&
    !empty($_SESSION['studentName']) &&
    !empty($_SESSION['studentId'])
) {
    $studentId = $_SESSION['studentId'];
    $stname = $_SESSION['studentName'];
} else {
?>
    <script>
        location.assign('../Login_Page/LoginForm.php')
    </script>
<?php
}
include_once "../Header/AdminHeader.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    /* General Styles */
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  display: flex;
}

.sidebar {
  width: 250px;
  background-color: #2C3E50;
  color: white;
  padding: 20px;
  position: fixed;
  height: 100%;
}

.sidebar .logo h2 {
  font-size: 24px;
  margin-bottom: 30px;
}

.sidebar nav a {
  color: white;
  display: block;
  padding: 10px;
  text-decoration: none;
  margin-bottom: 10px;
}

.sidebar nav a:hover {
  background-color: #34495E;
  border-radius: 5px;
}

.main-content {
  margin-left: 270px;
  padding: 20px;
  width: calc(100% - 270px);
}

header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.admin-info {
  font-size: 18px;
}

.logout {
  padding: 8px 16px;
  background-color: #E74C3C;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.search-bar {
  padding: 8px;
  width: 300px;
  border: 1px solid #BDC3C7;
  border-radius: 5px;
}

.notifications, .moderators, .moderation-form-section {
  margin-bottom: 40px;
}

h2 {
  font-size: 22px;
  margin-bottom: 20px;
}

.notification-card, .moderation-card {
  background-color: #ECF0F1;
  padding: 15px;
  margin-bottom: 15px;
  border-radius: 8px;
}

.notification-card h4, .moderation-card h4 {
  margin: 0;
}

.notification-card p, .moderation-card p {
  font-size: 14px;
}

.notification-card span {
  display: block;
  margin-top: 10px;
  font-size: 12px;
  color: #7F8C8D;
}

button {
  background-color: #3498DB;
  color: white;
  padding: 10px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin-top: 10px;
}

button:hover {
  background-color: #2980B9;
}

.moderation-form input, .moderation-form select {
  width: 100%;
  padding: 10px;
  margin: 10px 0;
  border: 1px solid #BDC3C7;
  border-radius: 5px;
}

.moderation-form button {
  width: 100%;
  background-color: #2ECC71;
  padding: 10px;
}

.moderation-form button:hover {
  background-color: #27AE60;
}

  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="logo">
      <h2>Admin</h2>
    </div>
    <nav>
      <a href="#">Dashboard</a>
      <a href="#">Users</a>
      <a href="#">Notifications</a>
      <a href="#">Moderation</a>
      <a href="#">Settings</a>
      <a href="#">Logout</a>
    </nav>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <header>
      <div class="admin-info">
        <span>Admin Name</span>
        <button class="logout">Logout</button>
      </div>
      <input type="text" class="search-bar" placeholder="Search...">
    </header>

    <!-- Notifications Section -->
    <section class="notifications">
      <h2>Recent Notifications</h2>
      <div class="notification-card">
        <h4>New User Registered</h4>
        <p>A new user has successfully registered. Please review their profile.</p>
        <span>2025-01-22</span>
        <button class="mark-read">Mark as Read</button>
      </div>
      <div class="notification-card">
        <h4>Profile Updated</h4>
        <p>John Doe has updated their profile information.</p>
        <span>2025-01-21</span>
        <button class="mark-read">Mark as Read</button>
      </div>
    </section>

    <!-- Moderators Section -->
    <section class="moderators">
      <h2>Moderators</h2>
      <div class="moderation-card">
        <h4>John Doe</h4>
        <p>Role: Senior Moderator</p>
        <button class="view-profile">View Profile</button>
        <button class="message">Send Message</button>
      </div>
      <div class="moderation-card">
        <h4>Jane Smith</h4>
        <p>Role: Junior Moderator</p>
        <button class="view-profile">View Profile</button>
        <button class="message">Send Message</button>
      </div>
    </section>

    <!-- Moderation Form -->
    <section class="moderation-form-section">
      <h2>Create New Moderation</h2>
      <form class="moderation-form">
        <label for="moderator-name">Moderator Name</label>
        <input type="text" id="moderator-name" name="moderator-name" required>

        <label for="moderator-role">Role</label>
        <select id="moderator-role" name="moderator-role" required>
          <option value="junior">Junior Moderator</option>
          <option value="senior">Senior Moderator</option>
          <option value="admin">Admin</option>
        </select>

        <button type="submit">Assign Moderator</button>
      </form>
    </section>
  </div>
</body>
</html>
