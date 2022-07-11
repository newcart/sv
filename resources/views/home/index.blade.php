<?php
$list1 = ["M"=>10, "T"=>0, "W"=>2, "T"=>2, "F"=>9, "S"=>5, "S"=>10];
$list2 = ["O"=>10, "T"=>0, "Ş"=>2, "T"=>2, "M"=>9, "N"=>5, "M"=>10];
$list3 = ["x"=>10, "y"=>0, "z"=>2, "t"=>2, "s"=>9, "m"=>5, "n"=>10];
$value1 = "1.25$";
$value2 = "10.50$";
$value3 = "325.00$";
$value4 = "1.50$";
$post1 = [
    'image'=> url('assets/img/home-decor-1.jpg'),
    'title'=>'Lorem Ipsum',
    'category'=>'News',
    'description'=>'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
    'url'=>'#',

];
$post2 = [
    'image'=> url('assets/img/home-decor-1.jpg'),
    'title'=>'Ut enim',
    'category'=>'Game',
    'description'=>'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
    'url'=>'#',

];
$post3 = [
    'image'=> url('assets/img/home-decor-1.jpg'),
    'title'=>'Nemo enim ipsam voluptatem',
    'category'=>'Social',
    'description'=>'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
    'url'=>'#',
];
$post4 = [
    'image'=> url('assets/img/home-decor-1.jpg'),
    'title'=>'Excepteur sint occaecat cupidatat',
    'category'=>'Software',
    'description'=>'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
    'url'=>'#',
];
?>
    <div class="row">
        <x-item.badgebox style="success" icon="schedule" title="Başlık" description="Açıklama" :value="$value1" />
        <x-item.badgebox style="info" icon="person" title="Başlık" description="Açıklama" :value="$value2" />
        <x-item.badgebox style="danger" icon="weekend" title="Başlık" description="Açıklama" :value="$value3" />
        <x-item.badgebox style="warning" icon="person" title="Başlık" description="Açıklama" :value="$value4" />
    </div>
    <div class="row mt-4">
        <x-item.cardbox type="line" style="danger" icon="schedule" title="Başlık" description="Açıklama" :list="$list1" />
        <x-item.cardbox type="bar" style="dark" icon="schedule" title="Başlık" description="Açıklama" :list="$list2" />
        <x-item.cardbox type="line" style="success" icon="schedule" title="Başlık" description="Açıklama" :list="$list3" />
    </div>
<div class="card card-body">
    <div class="row mt-4">
        <x-item.postbox style="danger" :post="$post1" />
        <x-item.postbox style="danger" :post="$post2" />
        <x-item.postbox style="danger" :post="$post3" />
        <x-item.postbox style="danger" :post="$post4" />
    </div>
</div>

