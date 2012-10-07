<?php 
// Jasmine CSS
echo $this->html->style(array('/lib/jasmine-1.2.0/jasmine')); 

// Jasmine Core
$scripts = array(
  '/lib/jasmine-1.2.0/jasmine',
  '/lib/jasmine-1.2.0/jasmine-html'
);

// App Specs
$scripts = array_merge($scripts, array(
  'spec/anologue'
));

// App Libs
$scripts = array_merge($scripts, array(
  'http://code.jquery.com/jquery-1.8.2.js',
  '/lib/md5.jquery',
  '/lib/showdown',
  '/lib/pretty',
  '/lib/jquery.oembed',
  'anologue',
));

echo $this->html->script($scripts);

?>

<script type="text/javascript">
  (function() {
    var jasmineEnv = jasmine.getEnv();
    jasmineEnv.updateInterval = 1000;

    var trivialReporter = new jasmine.TrivialReporter();

    jasmineEnv.addReporter(trivialReporter);

    jasmineEnv.specFilter = function(spec) {
      return trivialReporter.specFilter(spec);
    };

    var currentWindowOnload = window.onload;

    window.onload = function() {
      if (currentWindowOnload) {
        currentWindowOnload();
      }
      execJasmine();
    };

    function execJasmine() {
      jasmineEnv.execute();
    }

  })();
</script>