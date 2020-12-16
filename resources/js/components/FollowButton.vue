<template>
    <div>
        <a class="btn btn-primary px-4 font-weight-bold" @click="followUser" v-text="buttonText">Follow</a>
    </div>
</template>

<script>
	export default {
		mounted () {
			console.log( 'Component mounted.' )
		},

		props : [
			'userId',
			'follows'
		],

		data : function () {
			return {
				status : this.follows
			}
		},

		methods : {
			followUser () {
				axios.post( `/follow/${ this.userId }` )
					.then( response => {
						this.status = response.data.attached.length;
					} )
                    .catch(errors => {
                    	if (errors.response.status == 401)
                    		window.location = '/login'
                    });
			}
		},

		computed : {
			buttonText () {
				return this.status ? 'Unfollow' : 'Follow';
			}
		}
	}
</script>
