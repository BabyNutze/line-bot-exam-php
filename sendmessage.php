<!DOCTYPE html>
<html lang="en">
<head>
  <title>send message to line</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

  <div class="container contact-form">
              <div class="contact-image">
                  <img src="https://image.ibb.co/kUagtU/rocket_contact.png" alt="rocket_contact"/>
              </div>
              <form method="post">
                  <h3>Drop Us a Message</h3>
                 <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <input type="text" name="txtName" class="form-control" placeholder="Your Name *" value="" />
                          </div>
                          <div class="form-group">
                              <input type="text" name="txtEmail" class="form-control" placeholder="Your Email *" value="" />
                          </div>
                          <div class="form-group">
                              <input type="text" name="txtPhone" class="form-control" placeholder="Your Phone Number *" value="" />
                          </div>
                          <div class="form-group">
                              <input type="submit" name="btnSubmit" class="btnContact" value="Send Message" />
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <textarea name="txtMsg" class="form-control" placeholder="Your Message *" style="width: 100%; height: 150px;"></textarea>
                          </div>
                      </div>
                  </div>
              </form>
  </div>

</body>
</html>
