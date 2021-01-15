<section class="contact-me container mt-5 mb-5">
  <div id="contactMe">
    <h3>Send me an e-mail about this project!</h3>
    <form action="models/contact.php" method="POST">
    <div class="form-group">
      <input class="form-control"  type="text" class="inputs" name="name" placeholder="Send your Full Name">
    </div>
    <div class="form-group">
    <input class="form-control"  type="text" class="inputs" name="mail" placeholder="Send your E-Mail">
    </div>
    <div class="form-group">
      <input class="form-control"  type="text" class="inputs" name="subject" placeholder="What's worrying you?">
    </div>
    <div class="form-group">
      <textarea class="form-control"  name="message" id="textarea" placeholder="Subject" class="inputs"></textarea>
    </div>
    <div class="form-group">
      <input class="form-control"  type="submit" name="submit" id="submit" value="Send Mail">
    </div>
    </form>
  </div>
</section>