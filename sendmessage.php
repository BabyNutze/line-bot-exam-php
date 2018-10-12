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
              <form method="post" action="botpush.php">
                  <h3>Message</h3>
                 <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                            <label for="textmsg">message:</label>
                              <textarea name="txtMsg" class="form-control" rows="5"></textarea>
                          </div>
                          <button type="submit" class="btn btn-primary">ยืนยัน</button>
                      </div>
                  </div>
              </form>
  </div>

</body>
</html>
