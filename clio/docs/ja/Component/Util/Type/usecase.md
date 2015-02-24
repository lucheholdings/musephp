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


## フォーマット

```
type<internal_type>{options}
```

| ポジション                | フォーマット              | 説明                                                 |
|:------------------------- |:------------------------- |:---------------------------------------------------- |
| type                      | 文字列                    | 型の名称                                             |
| internal_type             | 文字列                    | 内部型　例えば、identifierという型は、データの装飾型であるため、その実内部クラスの名称 |
| options                   | json                      | FieldTypeのオプション                                |

例）

````
// DateTimeクラスを"Y-m-d"フォーマットで表す
DateTime{format: "Y-m-d"}

// ArrayCollectionをset（値の集合）とし、かつ、ArrayCollectionの内部オブジェクトをObjectクラスとして表す
set<ArrayCollection>{value_type: Object}

// ArrayCollectionをmap（keyで一意性をとった値）とし、かつ、ArrayCollectionの内部オブジェクトが、key=hooの場合、Fooクラス型とし、それ以外を、Objectクラス型として表す
map<ArrayCollection>{value_type: "Object", fields : {foo: "Foo"}}
````

----
[戻る](./index.md)
