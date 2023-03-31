<?php
  require_once("entities/product.class.php");
  require_once("entities/category.class.php");

  if(isset ($_POST["btnsubmit"]))
  {
    $productName = $_POST["txtName"];
    $cateID = $_POST["txtCateID"];
    $price = $_POST["txtprice"];
    $quantity = $_POST["txtquantity"];
    $description = $_POST["txtdesc"];
    $picture = $_FILES["txtpic"];
    //khởi tạo đői tượng product
    $newProduct = new Product ($productName, $cateID, $price, $quantity, $description, $picture);
    //lưu xuống CSDL
    $result = $newProduct->save();
    if(!$result)
    {
      header ("Location: add_product.php?failure");
    }
    else {
      header ("Location: add_product.php?inserted");
    }
  }
  ?>
  <?php include_once("header.php"); ?>
  <?php
  if(isset($GET["inserted"]))
  {
    echo "<h2>Thêm sản phẩm thành công</h2>";
  }
  ?>
  <!-- form sp -->
  <form method="post" enctype=”multipart/form-data” >
  <!-- Tên sán pham -->
    <div class="row">
      <div class="lbltitle">
        <label> Tên sản phẩm </label>
      </div>
    <div class="lblinput">
      <input type="text" name="txtName" value="<?php echo isset ($_POST["txtName"]) ? $_POST["txtName"] :"" ;?>" />
    </div>
  </div>
  <!-- mô tả sån phom -->
  <div class="row">
    <div class="lbltitle">
        <label>Mô tả sản phẩm</label>
    </div>
    <div class="lblinput">
      <textarea name="txtdesc" cols="21" rOWs="10" value=" <?php echo isset ($_POST["txtdesc"]) ? $_POST["txtdesc"] : ""; ?> "></textarea>
    </div>
  </div>
  <!-- so luong san pham -->
  <div class="row">
    <div class="lbltitle">
      <label> Số lượng </label>
    </div>
  <div class="lblinput">
    <input type="int" name="txtquantity" value="<?php echo isset ($_POST["txtquantity"]) ? $_POST["txtquantity"] :"" ;?>" />
  </div>
</div>
  <!-- giá san pham -->
  <div class="row">
    <div class="lbltitle">
      <label> Giá sản phẩm </label>
    </div>
  <div class="lblinput">
    <input type="double" name="txtprice" value="<?php echo isset ($_POST["txtprice"]) ? $_POST["txtprice"] :"" ;?>" />
  </div>
</div>
  <!-- loai sản phám -->
  <div class="row">
    <div class="lbltitle">
      <label> Chọn loại sản phẩm </label>
    </div>
  <div class="lblinput">
    <select name="txtCateID">
      <option value="" selected>--Chọn loại--</option>
      <?php
      $cates = Category::list_category();
      foreach($cates as $item)
      {
        echo "<option value=".$item["CateID"].">".$item["CategoryName"]."</option>";
      }
      ?>
    </select>
  </div>
</div>
  <!-- hinh anh -->
  <div class="row">
    <div class="lbltitle">
      <label> Hình ảnh </label>
    </div>
  <div class="lblinput">
    <input type="file" name="txtpic" accept=".PNG,.GIF,.JPG">
    
  </div>
</div>
  <!-- Nut gui form -->
  <div class="row">
    <div class="submit">
        <input type="submit" name="btnsubmit" value="Thêm sån phảm" />
    </div>
  </div>
  </form>
<?php include_once("footer.php"); ?>
