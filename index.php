<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.2/dist/bootstrap-table.min.css">
</head>
<body>
<?= '123'?>
<div class="container">
    <form action="">
        <input type="id">
        <button>送出</button>
    </form>
    <table
        id="table"
        data-toggle="table"
        data-sort-class="table-active"
        data-sortable="true"
        data-pagination="true"
        data-page-size="10"
        data-page-list="[10, 20, 50, 100, 200, All]"
        data-search="true">
        <thead class="thead-dark">
            <tr>
                <th data-field="id" data-sortable="true" data-searchable="false">#</th>
                <th data-field="img" data-sortable="false" data-searchable="false">封面</th>
                <th data-field="name" data-sortable="false" data-searchable="true">名稱</th>
                <th data-field="ori_dollar" data-sortable="true" data-searchable="true">原價</th>
                <th data-field="discount" data-sortable="true" data-searchable="true">折扣</th>
                <th data-field="dis_dollar" data-sortable="true" data-searchable="true">折價</th>
                <th data-field="screenshot" data-sortable="false" data-searchable="false">遊戲畫面</th>
            </tr>
        </thead>
        <tbody>
    <?php 
        $count = 1;  
        $url = 'https://store.steampowered.com/wishlist/id/skogkattt/wishlistdata';
        $results = json_decode(file_get_contents($url), true);

        foreach($results as $result) {
            $id = explode('/', $result['capsule'])[5];
            $discount = 100 - strval($result['subs'][0]["discount_pct"]);
            $dis_dollar = strval($result['subs'][0]["price"]) / 100;
            $ori_dollar = round($dis_dollar / ($discount / 100));
            ?><tr>
            <td><?= $count ?></td>
            <td><img src=<?= $result['capsule'] ?>></td>
            <td><a href="https://store.steampowered.com/app/<?= $id ?>/<?= $result['name'] ?>/"><?= $result['name'] ?></a></td>
            <td><?= $ori_dollar ?></td>
            <td><?= (100 == $discount) ? '-' : (0 - $discount) . ' %'?></td>
            <td><?= (100 == $discount) ? '-' : 'NT$ ' . $dis_dollar ?></td>
            <td><?php 
                foreach($result['screenshots'] as $screenshot) {
                    ?><img src="https://cdn.akamai.steamstatic.com/steam/apps/<?= $id ?>/<?= $screenshot ?>" style="width: 4rem;"><?
                }
            ?></td>
            </tr><?
            $count++;
        }
    ?>
        </tbody>
    </table>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.2/dist/bootstrap-table.min.js"></script>
</body>
</html>