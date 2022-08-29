<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Günlük Kur</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script
            src="https://code.jquery.com/jquery-3.6.1.js"
            integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
<table class="table">
    <thead>
    <tr>
        <th scope="col">Adet</th>
        <th scope="col">İsim</th>
        <th scope="col">Alış Fiyatı</th>
        <th scope="col">Satış Fiyatı</th>
    </tr>
    </thead>
    <tbody>
    <?php $i=10; foreach ($rows as $row){ if ($i>$row->id){ ?>
    <tr>
        <th scope="row">1</th>
        <td><?= $row->isim ?></td>
        <td><?= $row->alis ?> ₺</td>
        <td><?= $row->satis ?> ₺</td>
    </tr>
    <?php }} ?>
    </tbody>
</table>
<div class="container">
    <div class="row justify-content-md-center">
        <form justify-content-center action="<?= base_url("welcome/index") ?>" method="POST">
            <input type="hidden" name="buton">
            <button type="submit" class="btn btn-success">Güncelle</button>
        </form>
    </div>
</div>
<br><br>
<hr>
<div style="border-style: solid; " class="container">
    <div class="row">
        <div class="col-md-4">
            <h2>DOVIZ CEVIRICI</h2>
        </div>
    </div>
    <hr>
    <form action="" id="doviz" method="post">
    <input type="radio" id="al" checked="checked" name="alsat">
    <label for="al"">Alış</label>
    <input type="radio" id="sat" name="alsat">
    <label for="sat">Satış</label>
    </form>
    <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
        <div class="col">
            <input type="text" id="adet" name="adet" value="1">
        </div>
        <div class="col">
            <select name="" id="birim">
                <?php $i=10; foreach ($rows as $isim){ if ($i>$isim->id){ ?>
                    <option data-alis="<?= $isim->alis ?>" data-satis="<?= $isim->satis ?>" value="<?= $isim->id ?>"><?= $isim->isim ?></option>
                <?php } } ?>
            </select>
        </div>
        <div class="col">
            <h4> > </h4>
        </div>
        <div class="col">
            <input type="text" id="sonuc" disabled>
        </div>
        <div class="col">
            <select name="" id="degisim">
                <option data-al="1" data-sat="1" value="10">TL</option>
                <?php $i=10; foreach ($rows as $isim){ if ($i>$isim->id){ ?>
                    <option data-al="<?= $isim->alis ?>" data-sat="<?= $isim->satis ?>" value="<?= $isim->id ?>"><?= $isim->isim ?></option>
                <?php }} ?>
            </select>
        </div>
    </div>
</div>
<hr>
<br><br>
<script>
    function get(){
    var adet=$("#adet").val();
    var doviz=$('input[name=alsat]:checked', '#doviz').attr("id");
    let alis_id;
    let satis_id;
        if (doviz==="al"){
            alis_id=$("#birim :selected").val();
            satis_id=$("#degisim :selected").val();
            $.post( 'http://localhost/gunluk_kur/codeigniter/welcome/test',  {alisid:alis_id, satisid:satis_id},function (response) {
                let fiyat=response.alis_response / response.satis_response;
                let sonuc=fiyat * adet;
                $("#sonuc").val(sonuc.toFixed(4));
            });
        }else{
            satis_id=$("#birim :selected").val();
            alis_id=$("#degisim :selected").val();
            $.post( 'http://localhost/gunluk_kur/codeigniter/welcome/test',  {alisid:alis_id, satisid:satis_id},function (response) {
                let fiyat=response.satis_response / response.alis_response;
                let sonuc=fiyat * adet;
                $("#sonuc").val(sonuc.toFixed(4));
            });
        }
    }
    $("#birim").change(get);
    $("#degisim").change(get);
    $("#adet").change(get);
    $("#doviz").on('change',() => get());
    /*

     if (doviz==="al"){
        var fiyat=alis / degisecek_alis;
        var bolum=adet * fiyat;
        $("#sonuc").val(bolum.toFixed(4));
    }else{
        var fiyat=satis / degisecek_alis;
        var bolum=adet * fiyat;
        $("#sonuc").val(bolum.toFixed(4));
    }
    */
</script>
</body>
</html>
