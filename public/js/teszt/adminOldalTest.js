const { test } = QUnit;

QUnit.module("rendezés",  (h)=> {

  h.BEFORE(() => {
    this.rend=new AdminRend()

  });
  test("letezik-e", (assert)=> {
     
        assert.ok(this.rend.keresoMezo, "letezik");
     
  });
  test("function-e", (assert)=> {  
     
      assert.ok(typeof this.rend.keresoMezo==="function", "function");
   
});
test('minden felkapcsolva',(assert)=> {
  let oszlopnev=[]
  
  assert.equal(kicsiE(false,gepek),"9");
});

});
