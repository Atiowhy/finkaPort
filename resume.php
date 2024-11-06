<?php
include 'admin/koneksi.php';
$queryResume = mysqli_query($koneksi, "SELECT * FROM resume ORDER BY id DESC");
$rowResume = mysqli_fetch_assoc($queryResume);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Resume - Kelly Bootstrap Template</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <?php include 'inc/header.php'; ?>

<body class="resume-page">
  <main class="main">

    <!-- Resume Section -->
    <section id="resume" class="resume section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Resume</h2>
        <p></p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row">

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <h3 class="resume-title">Education</h3>

            <div class="resume-item">
              <h4><?php echo $rowResume['education'] ?></h4>
              <h5>2019 - 2023</h5>
              <p><em><?php echo $rowResume['sub_education'] ?></em></p>
              <p><?php echo $rowResume['text_education'] ?></p>
            </div><!-- Edn Resume Item -->
            
        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <h3 class="resume-title">Organization</h3>
            <div class="resume-item">
              <h4><?php echo $rowResume['organization'] ?></h4>
              <h5>2021 - 2022</h5>
              <p><em><?php echo $rowResume['sub_organization'] ?></em></p>
              <p><?php echo $rowResume['text_organization'] ?></p>
            </div><!-- Edn Resume Item -->
        </div>

          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <h3 class="resume-title">Internship</h3>
            <div class="resume-item">
              <h4><?php echo $rowResume['internship'] ?></h4>
              <h5>2024</h5>
              <p><em><?php echo $rowResume['sub_internship'] ?></em></p>
              <ul>
                <li><?php echo $rowResume['text_internship'] ?></li>
              </ul>
            </div><!-- Edn Resume Item -->

            <div class="resume-item">
              <h4>Liaison Officer</h4>
              <h5>2022 - 2023</h5>
              <p><em>Universitas Negeri Jakarta</em></p>
              <ul>
                <li>Assisted lecturers in giving courses</li>
                <li>Being a speaker in the classroom</li>
                <li>Managed of administration for visit activities</li>
                <li>Being a liaison between student and lecturers</li>
              </ul>
            </div><!-- Edn Resume Item -->

          </div>

        </div>

      </div>

    </section><!-- /Resume Section -->

  </main>

  <?php include 'inc/footer.php'; ?>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <?php include 'inc/js.php'; ?>

</body>

</html>