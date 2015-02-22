# 型の変換

型変換は、タイプ情報を基にデータを変換するためのツールです。
型の変換には、２つの方法を採用しています。

  - Type::convertData($data, Type $to)
  - Converter::convert(Type $from, Type $to, $data)
  
`Type::convertData`は、最も簡単な方法ですが、Typeクラスを拡張実装する必要があります。
このため、ライブラリなどで提供されているクラスの拡張は、内部動作への影響を考えるとコストが高いのが事実です。

`Converter::convert`は、より簡単な拡張ですが、別途Converter拡張クラスを実装し、Converterクラスを通して変換を行うなど実装コストが高くなりますが、高い拡張性を誇ります。

----

[戻る](./index.md)