<php?

?>

<form method="POST">
    <label for="carnumberinput"> Lisa autonumber </label>
    <input type="text" name="carnumberinput" id="carnumberinput" placeholder="Auto number" >
    <br>
    <label for="fullloadinput"> Lisa auto sisenemismass</label>
    <input type="text" name="fullloadinput" id="fullloadinput" placeholder="Auto sisenemismass" >
    <br>
    <label for="emptyloadinput"> Lisa auto valjumismass</label>
    <input type="text" name="emptyloadinput" id="emptyloadinput" placeholder="Auto sisenemismass" >
    <br>
    <input type="submit" name="datasubmit" value="Salvesta andmed">
  </form>
  <?php echo $inputerror ?>