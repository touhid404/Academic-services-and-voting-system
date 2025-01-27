
  <style>
    #unique-sticky-footer {
      margin-top: 120px;
      background-color: #ffffff; /* White background */
      color: #001f3f; /* Navy blue text */
      text-align: center;
      padding: 10px 0;
      box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    }

    #unique-footer-container {
      display: flex;
      justify-content: space-between;
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
    }

    #unique-footer-section {
      flex: 1;
      min-width: 200px;
      margin: 10px;
    }

    #aboutus {
      margin-bottom: 10px;
      font-size: 18px;
      color: #001f3f; /* Navy blue heading */
    }

    #intro, #quick-links {
      margin: 0;
      font-size: 14px;
      color: #001f3f; /* Navy blue text */
    }

    #quick-links {
      list-style: none;
      padding: 0;
    }

    #quick-links li {
      margin-bottom: 8px;
    }

    #quick-links a {
      color: #001f3f; /* Navy blue links */
      text-decoration: none;
    }

    #quick-links a:hover {
      color: #00aaff; /* Light blue hover effect */
      text-decoration: underline;
    }

    #unique-social-icons a {
      display: inline-block;
      margin-right: 10px;
    }

    #unique-social-icons img {
      width: 24px;
      height: 24px;
      filter: brightness(0) invert(0.5); /* Navy-like icons */
    }

    /* Footer Bottom */
    #unique-footer-bottom {
      border-top: 1px solid #e0e0e0; /* Light gray divider */
      margin-top: 15px;
      padding-top: 10px;
      font-size: 14px;
      color: #001f3f; 
    }
  </style>
</head>


  <footer id="unique-sticky-footer">
    <div id="unique-footer-container">
      <div id="unique-footer-section">
        <h4 id="aboutus">Exceptional Experiences</h4>
        <p id="intro">Creating impactful moments that leave a lasting impression.</p>
      </div>
      <div id="unique-footer-section">
        <h4 id="aboutus">Quick Links</h4>
        <ul id="quick-links">
          <li><a href="../Feedback/InsertFeedback.php">Give Feedback</a></li>
          <li><a href="../Feedback/AboutUs.php">About Us</a></li>
          <li><a href="../Feedback/PrivacyPolicy.php">Privacy Policy</a></li>
        </ul>
      </div>
      <div id="unique-footer-section">
        <h4 id="aboutus">Follow Us</h4>
        <div id="unique-social-icons">
          <a href="#"><img src="../Header/icons/fb.png" alt="Facebook"></a>
          <a href="#"><img src="../Header/icons/insta.png" alt="Instagram"></a>
          <a href="#"><img src="../Header/icons/git.png" alt="Github"></a>
        </div>
      </div>
    </div>
    <div id="unique-footer-bottom">
      <p>&copy; 2025. All rights reserved.</p>
    </div>
  </footer>

