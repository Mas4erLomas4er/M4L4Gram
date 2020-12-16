<div class="preloader" id="preloader">
    <div class="loader"></div>
</div>
<style>
    .preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-color: #fff;
        z-index: 500;
        display: flex;
        align-items: center;
        justify-content: center;
        -webkit-transition: 1s;
        -moz-transition: 1s;
        -ms-transition: 1s;
        -o-transition: 1s;
        transition: 1s;
        opacity: 1;
        visibility: visible;
    }

    .preloader.done {
        opacity: 0;
        visibility: hidden;
    }

    .preloader .loader {
        width: 150px;
        height: 150px;
        border: 3px solid #fff;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;
        border-top-color: #0095f6;
        animation: spin 2s infinite;
        -webkit-transition: 0.5s;
        -moz-transition: 0.5s;
        -ms-transition: 0.5s;
        -o-transition: 0.5s;
        transition: 0.5s;
        opacity: 1;
        visibility: visible;
    }

    .preloader.done .loader {
        animation-play-state: paused;
        opacity: 0;
        visibility: hidden;
    }

    @keyframes spin {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }
</style>
<script defer>
	window.addEventListener( 'load', () => {
		setTimeout( function () {
			let preloader = document.getElementById( 'preloader' );
			if ( !preloader.classList.contains( 'done' ) )
				preloader.classList.add( 'done' );
		}, 1000 )
	} );
</script>