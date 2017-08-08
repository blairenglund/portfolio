<?php
get_header();
?>

<div id="app">
  <h1>{{ message }}</h1>
  <button v-on:click="getPost()">Get Data</button>
  <p>{{ wpData }}</p>
</div>

<script type="text/javascript">
	var app = new Vue({
		el: '#app',
		data: {
			message: 'WELCOME TO MY APP',
			wpData: ''
		},
		methods: {
            getPost() {
                this.$http.get('wp-json').then(function(response) {
                	console.log(response.body)
                    this.$data.wpData = response.body.;
                }, function(response) {
                    // Error
                    console.log(response);
                });
            },
            
        }
	})


</script>

<?php
get_footer();
?>
