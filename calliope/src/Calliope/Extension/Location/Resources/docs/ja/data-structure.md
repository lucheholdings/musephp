データ構成
====

ロケーションデータは、以下のデータ構成です。

<table>
    <tr>
        <td>hash</td>
        <td>Metadataのhash値</td>
    </tr>
    <tr>
        <td>name</td>
        <td>ロケーションの名前（英数記号のみ）</td>
    </tr>
    <tr>
        <td>type</td>
        <td>ロケーションの種別<br />"country", "prefecture", "region", "city"などで構成</td>
    </tr>
    <tr>
        <td>attributes.label</td>
        <td>ロケーションの表記</td>
    </tr>
    <tr>
        <td>tags.in_xxx</td>
        <td>本ロケーションを包括する親ロケーションのハッシュタグ</td>
    </tr>
</table>


____

[一覧に戻る](./index.md)