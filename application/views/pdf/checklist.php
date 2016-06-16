<html ng-app="myApp">
    <head>
      <title>Casas Habitat</title>

      <meta charset="utf-8">
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width">
      <link rel='shortcut icon' href="<?= base_url('../img/casa.png') ?>" type='image/png' />

    </head>

    <body style="background-color: rgb(62, 62, 62);">
        <?php if (isset($pdf)): ?>
            <?php foreach ($pdf as $key => $value): ?>
                <object data="<?=base_url('../server/casas/files')?>/<?=$casa_k?>/<?=$value?>#zoom=100" type="application/pdf" width="100%" height="100%">
                </object>
                <br><br>
            <?php endforeach ?>
        <?php endif ?>
    </body>
</html>

