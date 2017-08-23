<?php
get_header();
?>
<content id="app">
	<article class="vh-100 dt w-100 v-mid avenir cover bg-green" v-bind:style="headerStyleObject">
		<div class="dtc v-mid tc ph3 ph7-l relative z-5">
			<div class="ph2 pv1 br4 bg-white">
				<h1 class="f-headline fw7 lh1 mb1 dark-gray baskerville italic"><i>{{ blogTitle }}</i></h1>
				<h2 class="f3 dark-gray ttu tracked mb5">{{ blogDescription }}</h2>				
			</div>
			<a class="f4 fw6 grow no-underline br4 mh2 ph4 pv2 mt3 dib dark-gray bg-white" href="#about"><span class="dark-gray tracked">About</span></a>
			<a class="f4 fw6 grow no-underline br4 mh2 ph4 pv2 mt3 dib dark-gray bg-white" href="#recent"><span class="dark-gray tracked">Projects</span></a>
			<a class="f4 fw6 grow no-underline br4 mh2 ph4 pv2 mt3 dib dark-gray bg-white" href="#contact"><span class="dark-gray tracked">Contact</span></a>
		</div>
	</article>

	<article id="about" class="vh-100 dt w-100 bg-light-green helvetica v-mid">
		<div class="dtc v-mid black-70 ph3 ph4-l">
			<h3>{{ postData }}</h3>
			<ul v-if:"typeof postData == Object">
				<li v-for="(value, index) in postData">
					<b>{{ index }}</b> - {{ value }}
				</li>
			</ul>
		</div>
	</article>

	<article id="about" class="vh-100 dt w-100 bg-light-pink helvetica v-mid">
		<div class="dtc v-mid tc dark-gray ph3 ph4-l">
			<h1></h1>
		</div>
	</article>

	<article id="contact" class="vh-100 dt w-100 bg-light-yellow helvetica v-mid">
		<div class="dtc v-mid tc black-70 ph3 ph4-l">
			
		</div>
	</article>

</content>
<script type="text/javascript">
	var app = new Vue({
		el: '#app',
		data: {
			blogTitle: '<?php echo get_bloginfo('name'); ?>',
			blogDescription: '<?php echo get_bloginfo('description'); ?>',
			postData: '',
			headerStyleObject: {
				background: ['url(<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' )[0]; ?>)'],
				backgroundBlendMode: 'hue'
			},
		},
		methods: {
            getBlogData() {
                this.$http.get('/wp-json').then(function(response) {
                	console.log(response.body)
                    this.$data.postData = response.body
                }, function(response) {
                    // Error
                    console.log(response);
                });
            },
            getPostData() {
                this.$http.get('/wp-json/wp/v2/pages/<?php the_id(); ?>').then(function(response) {
                	console.log(response.body)
                    this.$data.postData = response.body
                }, function(response) {
                    // Error
                    console.log(response);
                });
            },
        }
	})

	app.getPostData();

</script>

<?php
get_footer();
?>
