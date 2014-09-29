Finder
====

LocationFinderは、ロケーションオブジェクトを検索・取得するためのツールです。

LocationFinderは、対象ロケーションに含まれるロケーションの検索することを容易にする為に準備されています。

たとえば、国の一覧は、
    
    $finder = new LocationFinder($locationProvider);
    $finder
        ->type('country')
    ;
    $countries = $finder->getResults();

で取得が可能です。

より詳細な地域の一覧を取得する場合、例えば日本の広域地域（region）毎に都道府県を取得する場合は、
    
    // まず日本を取得
    $japan = $finder->type('country')->name('japan')->getResult();
    
    // in($japan)をデフォルトで行ってくれているFinderを取得
    $regionFinder = $japan->getFinder()->type('region');
    
    // ループで地域毎の都道府県を取得する
    foreach($regionFinder->getResults() as $region) {
        // 地域毎の都道府県取得用Finderを取得し、typeに都道府県(prefecture)を設定
        $prefFinder = $region->getFinder()->type('prefecture');
        // 地域毎に都道府県を配列に設定
        $prefs[$region->getName()] = $prefFinder->getResutls();
    }
    
[ロケーションの構成](./data-architect.md)を参照してください。

____

[一覧に戻る](./index.md)