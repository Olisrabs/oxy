<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
  <link href="images/favicon.png" rel="icon">
  <title>Oxyy - Login and Register Form Html Template</title>
  <meta name="description" content="Login and Register Form Html Template">
  <meta name="author" content="harnishdesign.net">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
</head>

<body>

  <div id="main-wrapper" class="oxyy-login-register h-100 d-flex flex-column bg-transparent">
    <div class="container my-auto">
      <div class="row">
        <div class="col-md-9 col-lg-7 col-xl-5 mx-auto">
          <div class="bg-white shadow-md rounded p-4 px-sm-5 mt-4">
            <div class="logo"> <a class="d-flex justify-content-center" href="index.html" title="Oxyy"><img src="images/logo-lg.png" alt="Oxyy"></a></div>
            <hr class="mx-n4 mx-sm-n5">
            <p class="lead text-center">Looks like you're new here!</p>

            <!-- Form -->
            <form id="registerForm" method="post" enctype="multipart/form-data">
              <?php
                include("db_conn.php");
                error_reporting(E_ALL);
                $rand = rand(1000, 9999);
                $today = date("ymd");
                $ID = "OXY-" . $today . $rand;
                if (isset($_REQUEST['submit'])) {
                  // Get form data
                  $uin = trim(addslashes($_REQUEST['uin']));
                  $fname = trim(addslashes($_REQUEST['fname']));
                  $email = trim(addslashes($_REQUEST['email']));
                  $phone = trim(addslashes($_REQUEST['phone']));
                  $gender = trim(addslashes($_REQUEST['gender']));
                  $state = trim(addslashes($_REQUEST['state']));
                  $lga = trim(addslashes($_REQUEST['lga']));
                  $password = trim(addslashes($_REQUEST['password']));
                  $dob = trim(addslashes($_REQUEST['dob']));

                  $passport = $uin . $_FILES['passport']["name"];
                  $target = "passport/";
                  $target = $target . $uin . $_FILES['passport']["name"];

                  $check = mysqli_query($conn, "SELECT * FROM user WHERE uin='$uin' OR email='$email' OR phone='$phone'");

                  $checkrow = mysqli_num_rows($check);

                  if ($checkrow > 0) {
                    echo "<script>alert('User already exists!');</script>";
                  } else {
                    if (move_uploaded_file($_FILES['passport']["tmp_name"], $target) > 0) {
                      $query = "INSERT INTO user (uin, fullname, email, phone, gender, state, lga, password, passport, dob) VALUES ('$uin', '$fname', '$email', '$phone', '$gender', '$state', '$lga', PASSWORD('$password'), '$passport', '$dob')";

                      $query2 = "INSERT INTO newsletter (fullname, email) VALUES ('$fname', '$email')";

                      $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                      $result2 = mysqli_query($conn, $query2) or die(mysqli_error($conn));
                      if ($result && $result2) {
                        echo "<script>alert('Registration successful!');</script>";
                      } else {
                        echo "<script>alert('Registration failed!');</script>";
                      }
                    }
                  }
                }
              ?>

              <!-- Step 1 -->
              <div class="section" id="step1">
                <!-- UIN -->
                <input type="hidden" name="uin" id="uin" value="<?php echo $ID; ?>">
                <!-- Name -->
                <div class="mb-3">
                  <label for="fname" class="form-label">Full Name</label>
                  <input type="text" class="form-control" name="fname" id="fname" placeholder="Enter your full name"
                    required>
                </div>
                <!-- Email -->
                <div class="mb-3">
                  <label for="email" class="form-label">Email Address</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email"
                    required>
                </div>
                <!-- Phone -->
                <div class="mb-3">
                  <label for="phone" class="form-label">Phone</label>
                  <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter your phone number"
                    required>
                </div>
                <!-- To next step -->
                <div class="d-grid my-4">
                  <button class="btn btn-primary" onclick="showNext()">Next Step&nbsp;&nbsp;&rarr;</button>
                </div>
              </div>

              <!-- Step 2 -->
              <div class="section hide" id="step2">
                <!-- To previous -->
                <div class="section" id="previous">
                  <span onclick="showPrevious()"
                    style="color: blue; text-decoration: underline; cursor: pointer;">back</span>
                </div>
                <!-- Gender -->
                <div class="mb-3">
                  <label for="gender" class="form-label">Gender</label>
                  <select name="gender" id="gender" class="form-control" required>
                    <option value="">-- Select gender --</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                  </select>
                </div>
                <!-- State -->
                <div class="mb-3">
                  <label for="state" class="form-label">State</label>
                   <select name="state" id="state" class="form-control" onchange="updateLGA()">
                      <option value="">-- Select state --</option>
                   </select>
                </div>
                <!-- Local Government Area -->
                <div class="mb-3">
                  <label for="lga" class="form-label">L.G.A</label>
                   <select name="lga" id="lga" class="form-control">
                      <option value="">-- Select LGA --</option>
                   </select>
                </div>
                <!-- To next step -->
                <div class="d-grid my-4">
                  <button class="btn btn-primary" onclick="showNext()">Next Step&nbsp;&nbsp;&rarr;</button>
                </div>
              </div>

              <!-- Step 3 -->
              <div class="section hide" id="step3">
                <!-- To previous -->
                <div class="section" id="previous">
                  <span onclick="showPrevious()"
                    style="color: blue; text-decoration: underline; cursor: pointer;">back</span>
                </div>
                <!-- dob -->
                <div class="mb-3">
                  <label for="dob" class="form-label">DOB</label>
                  <input type="date" class="form-control" id="dob" name="dob" required>
                </div>
                <!-- Passport -->
                <div class="mb-3">
                  <label for="passport" class="form-label">Passport</label>
                  <input type="file" class="form-control" id="passport" name="passport"
                    accept="image/.png,.jpg,.jpeg,.PNG,.JPG,.JPEG" required>
                </div>
                <!-- Password -->
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input oninput="validatePassword()" type="password" class="form-control" name="password" id="password" placeholder="Enter Password"
                    required>
                </div>
                <!-- Password Message -->
                <div id="message"></div>
                <!-- Confirm Password -->
                <div class="mb-3">
                  <label for="confirmPassword" class="form-label">Confirm Password</label>
                  <input oninput="validatePassword()" type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password"
                    required>
                </div>
                <!-- Password Message 2 -->
                <div id="message2"></div>
                <!-- Submit -->
                <div class="d-grid my-4">
                  <button class="btn btn-primary" name="submit" type="submit"
                    onclick="return confirm('Do you want to submit this form?');">Sign Up</button>
                </div>
              </div>


            </form>
            <p class="text-center text-muted mb-2">Already have an account? <a href="login-4.html">Log In</a></p>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid py-3">
      <p class="text-center text-2 text-muted mb-0">Copyright © 2021 <a href="#">Oxyy</a>. All Rights Reserved.</p>
    </div>
  </div>

  <script type="text/javascript">
    function validatePassword() {
      let password = document.getElementById("password").value;
      let confirmPassword = document.getElementById("confirmPassword").value;
      let message = document.getElementById("message");
      let message2 = document.getElementById("message2");

      if (password.length < 8) {
        message.innerHTML = "<p style='color: red;'>Password must be at least 8 characters long.</p>";
        return;
      } else {
        message.innerHTML = "<p style='color: green;'>Password is valid.</p>";
      }

      if (password !== confirmPassword) {
        message2.innerHTML = "<p style='color: red;'>Passwords do not match.</p>";
      } else {
        message2.innerHTML = "<p style='color: green;'>Passwords match.</p>";
      }
    }

    function showNext() {
      let step1 = document.getElementById("step1");
      let step2 = document.getElementById("step2");
      let step3 = document.getElementById("step3");
      let fname = document.getElementById("fname").value;
      let email = document.getElementById("email").value;
      let phone = document.getElementById("phone").value;
      let gender = document.getElementById("gender").value;
      let state = document.getElementById("state").value;
      let lga = document.getElementById("lga").value;


      if (step2.classList.contains("hide") && step3.classList.contains("hide")) {
        if (fname && email && phone) {
          step1.classList.add("hide");
          step2.classList.remove("hide");
        } else {
          alert("Please fill in all fields.");
        }
      } else if (step1.classList.contains("hide") && step3.classList.contains("hide")) {
        if (gender && state && lga) {
          step2.classList.add("hide");
          step3.classList.remove("hide");
        } else {
          alert("Please fill in all fields.");
        }
      }
    }

    function showPrevious() {
      let step1 = document.getElementById("step1");
      let step2 = document.getElementById("step2");
      let step3 = document.getElementById("step3");

      if (step1.classList.contains("hide") && step3.classList.contains("hide")) {
        step2.classList.add("hide");
        step1.classList.remove("hide");
      } else if (step1.classList.contains("hide") && step2.classList.contains("hide")) {
        step3.classList.add("hide");
        step2.classList.remove("hide");
      }
    }

    const nigeriaData = {
    "Abia": ["Aba North", "Aba South", "Arochukwu", "Bende", "Ikwuano", "Isiala Ngwa North", "Isiala Ngwa South", "Isuikwuato", "Obi Ngwa", "Ohafia", "Osisioma", "Ugwunagbo", "Ukwa East", "Ukwa West", "Umuahia North", "Umuahia South", "Umu Nneochi"],
    "Adamawa": ["Demsa", "Fufore", "Ganye", "Girei", "Gombi", "Guyuk", "Hong", "Jada", "Lamurde", "Madagali", "Maiha", "Mayo-Belwa", "Michika", "Mubi North", "Mubi South", "Numan", "Shelleng", "Song", "Toungo", "Yola North", "Yola South"],
    "Akwa Ibom": ["Abak", "Eastern Obolo", "Eket", "Esit Eket", "Essien Udim", "Etim Ekpo", "Etinan", "Ibeno", "Ibesikpo Asutan", "Ibiono-Ibom", "Ika", "Ikono", "Ikot Abasi", "Ikot Ekpene", "Ini", "Itu", "Mbo", "Mkpat-Enin", "Nsit-Atai", "Nsit-Ibom", "Nsit-Ubium", "Obot Akara", "Okobo", "Onna", "Oron", "Oruk Anam", "Udung-Uko", "Ukanafun", "Uruan", "Urue-Offong/Oruko", "Uyo"],
    "Anambra": ["Aguata", "Anambra East", "Anambra West", "Anaocha", "Awka North", "Awka South", "Ayamelum", "Dunukofia", "Ekwusigo", "Idemili North", "Idemili South", "Ihiala", "Njikoka", "Nnewi North", "Nnewi South", "Ogbaru", "Onitsha North", "Onitsha South", "Orumba North", "Orumba South", "Oyi"],
    "Bauchi": ["Alkaleri", "Bauchi", "Bogoro", "Damban", "Darazo", "Dass", "Ganjuwa", "Giade", "Itas/Gadau", "Jama'are", "Katagum", "Kirfi", "Misau", "Ningi", "Shira", "Tafawa Balewa", "Toro", "Warji", "Zaki"],
    "Bayelsa": ["Brass", "Ekeremor", "Kolokuma/Opokuma", "Nembe", "Ogbia", "Sagbama", "Southern Ijaw", "Yenagoa"],
    "Benue": ["Ado", "Agatu", "Apa", "Buruku", "Gboko", "Guma", "Gwer East", "Gwer West", "Katsina-Ala", "Konshisha", "Kwande", "Logo", "Makurdi", "Obi", "Ogbadibo", "Ohimini", "Oju", "Okpokwu", "Oturkpo", "Tarka", "Ukum", "Ushongo", "Vandeikya"],
    "Borno": ["Abadam", "Askira/Uba", "Bama", "Bayo", "Biu", "Chibok", "Damboa", "Dikwa", "Gubio", "Guzamala", "Gwoza", "Hawul", "Jere", "Kaga", "Kala/Balge", "Konduga", "Kukawa", "Kwaya Kusar", "Mafa", "Magumeri", "Maiduguri", "Marte", "Mobbar", "Monguno", "Ngala", "Nganzai", "Shani"],
    "Cross River": ["Abi", "Akamkpa", "Akpabuyo", "Bakassi", "Bekwarra", "Biase", "Boki", "Calabar Municipal", "Calabar South", "Etung", "Ikom", "Obanliku", "Obubra", "Obudu", "Odukpani", "Ogoja", "Yakuur", "Yala"],
    "Delta": ["Aniocha North", "Aniocha South", "Bomadi", "Burutu", "Ethiope East", "Ethiope West", "Ika North East", "Ika South", "Isoko North", "Isoko South", "Ndokwa East", "Ndokwa West", "Okpe", "Oshimili North", "Oshimili South", "Patani", "Sapele", "Udu", "Ughelli North", "Ughelli South", "Ukwuani", "Warri North", "Warri South", "Warri South West"],
    "Ebonyi": ["Abakaliki", "Afikpo North", "Afikpo South", "Ebonyi", "Ezza North", "Ezza South", "Ikwo", "Ishielu", "Ivo", "Izzi", "Ohaozara", "Ohaukwu", "Onicha"],
    "Edo": ["Akoko-Edo", "Egor", "Esan Central", "Esan North-East", "Esan South-East", "Esan West", "Etsako Central", "Etsako East", "Etsako West", "Igueben", "Ikpoba-Okha", "Oredo", "Orhionmwon", "Ovia North-East", "Ovia South-West", "Owan East", "Owan West", "Uhunmwonde"],
    "Ekiti": ["Ado Ekiti", "Efon", "Ekiti East", "Ekiti South-West", "Ekiti West", "Emure", "Gbonyin", "Ido Osi", "Ijero", "Ikere", "Ikole", "Ilejemeje", "Irepodun/Ifelodun", "Ise/Orun", "Moba", "Oye"],
    "Enugu": ["Aninri", "Awgu", "Enugu East", "Enugu North", "Enugu South", "Ezeagu", "Igbo Etiti", "Igbo Eze North", "Igbo Eze South", "Isi Uzo", "Nkanu East", "Nkanu West", "Nsukka", "Oji River", "Udenu", "Udi", "Uzo Uwani"],
    "FCT": ["Abaji", "Bwari", "Gwagwalada", "Kuje", "Kwali", "Municipal Area Council"],
    "Gombe": ["Akko", "Balanga", "Billiri", "Dukku", "Funakaye", "Gombe", "Kaltungo", "Kwami", "Nafada", "Shongom", "Yamaltu/Deba"],
    "Imo": ["Aboh Mbaise", "Ahiazu Mbaise", "Ehime Mbano", "Ezinihitte", "Ideato North", "Ideato South", "Ihitte/Uboma", "Ikeduru", "Isiala Mbano", "Isu", "Mbaitoli", "Ngor Okpala", "Njaba", "Nkwerre", "Nwangele", "Obowo", "Oguta", "Ohaji/Egbema", "Okigwe", "Orlu", "Orsu", "Oru East", "Oru West", "Owerri Municipal", "Owerri North", "Owerri West"],
    "Jigawa": ["Auyo", "Babura", "Biriniwa", "Birnin Kudu", "Buji", "Dutse", "Gagarawa", "Garki", "Gumel", "Guri", "Gwaram", "Gwiwa", "Hadejia", "Jahun", "Kafin Hausa", "Kaugama", "Kazaure", "Kiri Kasama", "Kiyawa", "Maigatari", "Malam Madori", "Miga", "Ringim", "Roni", "Sule Tankarkar", "Taura", "Yankwashi"],
    "Kaduna": ["Birnin Gwari", "Chikun", "Giwa", "Igabi", "Ikara", "Jaba", "Jema'a", "Kachia", "Kaduna North", "Kaduna South", "Kagarko", "Kajuru", "Kaura", "Kauru", "Kubau", "Kudan", "Lere", "Makarfi", "Sabon Gari", "Sanga", "Soba", "Zangon Kataf", "Zaria"],
    "Kano": ["Ajingi", "Albasu", "Bagwai", "Bebeji", "Bichi", "Bunkure", "Dala", "Dambatta", "Dawakin Kudu", "Dawakin Tofa", "Doguwa", "Fagge", "Gabasawa", "Garko", "Garun Mallam", "Gaya", "Gezawa", "Gwale", "Gwarzo", "Kabo", "Kano Municipal", "Karaye", "Kibiya", "Kiru", "Kumbotso", "Kunchi", "Kura", "Madobi", "Makoda", "Minjibir", "Nasarawa", "Rano", "Rimin Gado", "Rogo", "Shanono", "Sumaila", "Takai", "Tarauni", "Tofa", "Tsanyawa", "Tudun Wada", "Ungogo", "Warawa", "Wudil"],
    "Katsina": ["Bakori", "Batagarawa", "Batsari", "Baure", "Bindawa", "Charanchi", "Dandume", "Danja", "Dan Musa", "Daura", "Dutsi", "Dutsin Ma", "Faskari", "Funtua", "Ingawa", "Jibia", "Kafur", "Kaita", "Kankara", "Kankia", "Katsina", "Kurfi", "Kusada", "Mai'Adua", "Malumfashi", "Mani", "Mashi", "Matazu", "Musawa", "Rimi", "Sabuwa", "Safana", "Sandamu", "Zango"],
    "Kebbi": ["Aleiro", "Arewa Dandi", "Argungu", "Augie", "Bagudo", "Birnin Kebbi", "Bunza", "Dandi", "Fakai", "Gwandu", "Jega", "Kalgo", "Koko/Besse", "Maiyama", "Ngaski", "Sakaba", "Shanga", "Suru", "Wasagu/Danko", "Yauri", "Zuru"],
    "Kogi": ["Adavi", "Ajaokuta", "Ankpa", "Bassa", "Dekina", "Ibaji", "Idah", "Igalamela-Odolu", "Ijumu", "Kabba/Bunu", "Kogi", "Lokoja", "Mopa-Muro", "Ofu", "Ogori/Magongo", "Okehi", "Okene", "Olamaboro", "Omala", "Yagba East", "Yagba West"],
    "Kwara": ["Asa", "Baruten", "Edu", "Ekiti", "Ifelodun", "Ilorin East", "Ilorin South", "Ilorin West", "Irepodun", "Isin", "Kaiama", "Moro", "Offa", "Oke Ero", "Oyun", "Pategi"],
    "Lagos": ["Agege", "Ajeromi-Ifelodun", "Alimosho", "Amuwo-Odofin", "Apapa", "Badagry", "Epe", "Eti-Osa", "Ibeju-Lekki", "Ifako-Ijaiye", "Ikeja", "Ikorodu", "Kosofe", "Lagos Island", "Lagos Mainland", "Mushin", "Ojo", "Oshodi-Isolo", "Shomolu", "Surulere"],
    "Nasarawa": ["Akwanga", "Awe", "Doma", "Karu", "Keana", "Keffi", "Kokona", "Lafia", "Nasarawa", "Nasarawa Egon", "Obi", "Toto", "Wamba"],
    "Niger": ["Agaie", "Agwara", "Bida", "Borgu", "Bosso", "Chanchaga", "Edati", "Gbako", "Gurara", "Katcha", "Kontagora", "Lapai", "Lavun", "Magama", "Mariga", "Mashegu", "Mokwa", "Muya", "Paikoro", "Rafi", "Rijau", "Shiroro", "Suleja", "Tafa", "Wushishi"],
    "Ogun": ["Abeokuta North", "Abeokuta South", "Ado-Odo/Ota", "Egbado North", "Egbado South", "Ewekoro", "Ifo", "Ijebu East", "Ijebu North", "Ijebu North East", "Ijebu Ode", "Ikenne", "Imeko-Afon", "Ipokia", "Obafemi Owode", "Odeda", "Odogbolu", "Ogun Waterside", "Remo North", "Shagamu"],
    "Ondo": ["Akoko North-East", "Akoko North-West", "Akoko South-East", "Akoko South-West", "Akure North", "Akure South", "Ese Odo", "Idanre", "Ifedore", "Ilaje", "Ile Oluji/Okeigbo", "Irele", "Odigbo", "Okitipupa", "Ondo East", "Ondo West", "Ose", "Owo"],
    "Osun": ["Atakunmosa East", "Atakunmosa West", "Aiyedaade", "Aiyedire", "Boluwaduro", "Boripe", "Ede North", "Ede South", "Egbedore", "Ejigbo", "Ife Central", "Ife East", "Ife North", "Ife South", "Ifedayo", "Ifelodun", "Ila", "Ilesa East", "Ilesa West", "Irepodun", "Irewole", "Isokan", "Iwo", "Obokun", "Odo Otin", "Ola Oluwa", "Olorunda", "Oriade", "Orolu", "Osogbo"],
    "Oyo": ["Afijio", "Akinyele", "Atiba", "Atisbo", "Egbeda", "Ibadan North", "Ibadan North-East", "Ibadan North-West", "Ibadan South-East", "Ibadan South-West", "Ibarapa Central", "Ibarapa East", "Ibarapa North", "Ido", "Irepo", "Iseyin", "Itesiwaju", "Iwajowa", "Kajola", "Lagelu", "Ogbomosho North", "Ogbomosho South", "Ogo Oluwa", "Olorunsogo", "Oluyole", "Ona Ara", "Orelope", "Ori Ire", "Oyo East", "Oyo West", "Saki East", "Saki West", "Surulere"],
    "Plateau": ["Barkin Ladi", "Bassa", "Bokkos", "Jos East", "Jos North", "Jos South", "Kanam", "Kanke", "Langtang North", "Langtang South", "Mangu", "Mikang", "Pankshin", "Qua'an Pan", "Riyom", "Shendam", "Wase"],
    "Rivers": ["Abua/Odual", "Ahoada East", "Ahoada West", "Akuku-Toru", "Andoni", "Asari-Toru", "Bonny", "Degema", "Eleme", "Emohua", "Etche", "Gokana", "Ikwerre", "Khana", "Obio/Akpor", "Ogba/Egbema/Ndoni", "Ogu/Bolo", "Okrika", "Omuma", "Opobo/Nkoro", "Oyigbo", "Port Harcourt", "Tai"],
    "Sokoto": ["Binji", "Bodinga", "Dange Shuni", "Gada", "Goronyo", "Gudu", "Gwadabawa", "Illela", "Isa", "Kebbe", "Kware", "Rabah", "Sabon Birni", "Shagari", "Silame", "Sokoto North", "Sokoto South", "Tambuwal", "Tangaza", "Tureta", "Wamako", "Wurno", "Yabo"],
    "Taraba": ["Ardo Kola", "Bali", "Donga", "Gashaka", "Gassol", "Ibi", "Jalingo", "Karim Lamido", "Kumi", "Lau", "Sardauna", "Takum", "Ussa", "Wukari", "Yorro", "Zing"],
    "Yobe": ["Bade", "Bursari", "Damaturu", "Fika", "Fune", "Geidam", "Gujba", "Gulani", "Jakusko", "Karasuwa", "Machina", "Nangere", "Nguru", "Potiskum", "Tarmuwa", "Yunusari", "Yusufari"],
    "Zamfara": ["Anka", "Bakura", "Birnin Magaji/Kiyaw", "Bukkuyum", "Bungudu", "Gummi", "Gusau", "Kaura Namoda", "Maradun", "Maru", "Shinkafi", "Talata Mafara", "Chafe", "Zurmi"]
};

// Populate states
const stateSelect = document.getElementById("state");
Object.keys(nigeriaData).forEach(state => {
    const option = document.createElement("option");
    option.value = state;
    option.textContent = state;
    stateSelect.appendChild(option);
});

// Update LGAs when state changes
function updateLGA() {
    const lgaSelect = document.getElementById("lga");
    const selectedState = stateSelect.value;
    lgaSelect.innerHTML = '<option value="">-- Select LGA --</option>';

    if (selectedState && nigeriaData[selectedState]) {
        nigeriaData[selectedState].forEach(lga => {
            const option = document.createElement("option");
            option.value = lga;
            option.textContent = lga;
            lgaSelect.appendChild(option);
        });
    }
}
  </script>
</body>

</html>