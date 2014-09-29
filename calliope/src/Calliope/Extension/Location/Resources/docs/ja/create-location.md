位置情報を作成する
====

## Builderクラスを用いた生成

  位置情報の最も簡単な生成方法は、Builderクラスを用いることです。
  Builderクラスを用いた生成は、以下の通りです。
  
````php
    $builder = Builder::create();
    $builder
        ->setType('prefecture')
        ->setName('hokkaido')
        ->locatedIn($japanLocation)
        ->locatedIn($hokkaitoTohokuRegion)
        ->setLatLng($latitude, $longiture)
    ;
    
    $hokkaido = $builder->build();
````

上述の例では、Builderクラスを用いて、$japanと$hokkaidoTohokuRegionに属する、hokkiadoという位置情報を生成しています。

ここでいうtypeは、Calliope\Extension\Location\Type\Typeを継承したクラスです。
Typeを拡張するには、[拡張Typeを登録する]()を参照してください。
