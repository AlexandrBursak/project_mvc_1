<main>
  <div class="row">
    <section class="col-md-12">
      <div class="container">
        <article class="jumbotron">
          <h1><?php echo $data['content_h1']; ?></h1>

          <form action="<?php echo $permalink; ?>contact/send?action=hello-kitty" method="POST">
            <div class="form-group">
              <label for="email_form">Email address</label>
              <input type="email" name="email" id="email_form" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
              <label for="fio_form">FIO</label>
              <input type="fio" id="fio_form" class="form-control" placeholder="Enter FIO">
            </div>
            <div class="form-group">
              <label for="subject_form">Subject</label>
              <input type="subject" id="subject_form" class="form-control" placeholder="Enter subject">
            </div>
            <div class="form-group">
              <label for="message_form">Your message</label>
              <textarea name="message" class="form-control" id="message_form" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>

        </article>
      </div>
    </section>

  </div>
</main>