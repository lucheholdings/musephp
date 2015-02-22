# 型の利用

Typeクラスを利用する多くの場合、Typeは不十分な情報であると感じるはずです。  
例えば、クラスプロパティ Class:$arrayは、配列型であるとします。　しかし、配列の中がどのような構造なのかを知らない限り、配列の中の情報を用いることはできません。

このように、ユースケースの型は、Typeクラスの拡張でなくてはいけません。

Clio.Component.Util.Typeコンポーネントでは、ユースケースのために、`FieldType`を準備しています。


```
$fieldType = new FieldType(new MixedType());
```

FieldTypeは、文字列からその内部構成などを設定することも可能です。
```
// 特定クラス ClassのIdentifier型
$fieldType = new FieldType('identifier<Class>');

// スキーマを用いた配列
$fieldType = new FieldType('array{key1: string, key2: integer}')
```

FieldTypeの内部タイプを解決するために、FieldType::setTypeRegistry(TypeRegistry)を用いて、TypeRegistryを登録する必要があります。

----
[戻る](./index.md)
