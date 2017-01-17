<?php 
    include 'FavoriteItem.class.php';
    include 'CartItem.class.php';
    session_start();
    include 'includes/head.inc.php';
?>
<body >
    
<?php 
include ('includes/header.inc.php');
?>
    
<main class="ui container">
    <div class="ui hidden divider"></div>
    <div class="ui center aligned teal segment">
        <h1>About Us</h1>
   <h4>Web II: Web Application and Development - COMP 3512</h4>
    <h4>Assignment	#3 (expand on first two	assignment)</h4>
    <h4> Resources: Web Development TextBook | Semantic UI </h4>
    </div>

<div class="ui items">
 <div class="item">
  <div class="ui medium image">
    <img src="images/Amandeep/mruogo.jpg">
  </div>
  <div class="middle aligned content">

    <h4 class="ui horizontal divider header">
  <i class="tag icon"></i>
  Site Information
</h4>
<p>This site is hypothetical and is created as a term project for COMP 3512 at Mount Royal University taught by Randy Connolly.</p>
</br>
<h4 class="ui horizontal divider header">
  <i class="bar chart icon"></i>
  Team Members
</h4>
<table class="ui definition table">
  <tbody>
   <tr>
      <td class="two wide column">Josh</td>
      <td>Painting Preview</td>
      <td>Cart</td>
      <td></td>
      <td></td>
    </tr>
    </br>
       
     <tr>
      <td class="two wide column">Aman</td>
      <td>Browse Paintings</td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
   </br>
     <tr>
      <td class="two wide column">Umida</td>
      <td>Simple Search</td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
   
  </tbody>
</table>

</main>    
    <div class="ui segment">
     <p id="date"> Date:
    <script>
    document.getElementById("date").innerHTML = Date();
    </script>
     </p>
  </div>
  <?php include("includes/footer.inc.php"); ?>
  
</body>
