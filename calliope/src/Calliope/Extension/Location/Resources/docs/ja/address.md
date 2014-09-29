Location - 住所コンポーネント
====

住所コンポーネントは、ロケーションに住所情報を付与するための仕組みです。 
ロケーションは、住所コンポーネントをアトリビュートに"address."の形で登録されます。 

住所をつけて新しいロケーションを生成する(AddressLocationBuilder)
----

	//$parentLocationは、"札幌市"のロケーション
	$builder = new AddressLocationBuilder($japan->getAddressSchema());
	$builder
		->in($parentLocation)
		->type('ward')
		->getAddressBuilder()
			->set('ward', '中央区')
	;

	$location = $builder->build();

	// "北海道札幌市中央区"
	$location->getAddress()->labelFull();

	//{
	//	'country' : '日本'
	//	'prefecture' : '北海道', 
	//	'city' : '札幌市',
	//	'ward' : '中央区'
	//}
	$location->getAddress()


住所コンポーネントを生成する
----
	
	$builder = $japan->createAddressBuilder();
	$builder
		->set('city', '札幌市')
	;

	// 日本の住所スキーマには、'state'が無いため、設定するとExceptionになります。
	$builder
		->set('state', 'hokkaido')
	;

