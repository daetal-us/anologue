describe("Anologue", function() {

	it("has a database", function() {
		expect(Anologue.db).toBeDefined();
		expect(Anologue.db).toEqual({});
	});

	it("has a configuration", function() {
		expect(Anologue._config).toBeDefined();

		var config = {
			id: 0,
			seq: 0,
			base : null,
			line: 0,
			icon: null
		};
		expect(Anologue._config).toEqual(config);
	});

	it("is configurable", function() {
		var test = Anologue;
		var config = {
			id: 1234,
			seq: 5678,
			base: '/my/path',
			line: 47,
			icon: 'avatar.jpg'
		};
		test.config(config);
		expect(test._config).toEqual(config);
	});

});