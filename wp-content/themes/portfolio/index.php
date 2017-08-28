<?php
get_header();
?>
<div id="app" class="bg-dark-gray">
	<article class="vh-100 dt w-100 v-mid avenir cover diamond" v-bind:style="headerStyleObject">
		<div class="dtc tc v-mid ph4 relative z-5">
			<div class="ph2 pv1 br4" v-bind:class="">
				<h1 class="f-headline fw2 tracked ttl lh1 mb2 white pearl pearl-text">{{ blogTitle }}</h1>
				<h2 class="f3 fw6 washed-green ttu tracked mb5">{{ blogDescription }}</h2>				
			</div>
		</div>
	</article>

	<article id="about" class="vh-100 dt w-100 avenir v-mid pearl">
		<div class="dtc v-mid black-70 ph3 ph4-l mid-gray">
			<h3>{{ postData }}</h3>
			<ul v-if:"typeof postData == Object">
				<li v-for="(value, index) in postData">
					<b>{{ index }}</b> - {{ value }}
				</li>
			</ul>
		</div>
	</article>

	<article id="projects" class="vh-100 dt w-100 helvetica v-mid">
		<div class="dark-gray ph3 ph4-l">
			<div v-for="project in projects">
				<h3 class="f1">{{ project.title.rendered }}</h3>
			</div>
		</div>
	</article>

	<article id="contact" class="vh-100 dt w-100 helvetica v-mid">
		<div class="dtc v-mid tc black-70 ph3 ph4-l">
			
		</div>
	</article>

</div>


<script type="text/javascript">
	var app = new Vue({
		el: '#app',
		data: {
			blogTitle: '<?php echo get_bloginfo('name'); ?>',
			blogDescription: '<?php echo get_bloginfo('description'); ?>',
			postData: '',
			headerStyleObject: {
				background: '<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' )[0]; ?>' ? ['url(<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' )[0]; ?>)'] : ''
			},
			projects: '',
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
            getProjects() {
                this.$http.get('/wp-json/wp/v2/project').then(function(response) {
                	console.log(response.body)
                    this.$data.projects = response.body
                }, function(response) {
                    // Error
                    console.log(response);
                });
            }
        }
	})

	//app.getProjects()

</script>

<?php
get_footer();
?>
