<style>
    /* .deal-banner{
        margin-top: 700px !important;
        display: block !important;
        position: relative !important;
    } */
    @media only screen and (max-width: 767px) {

        /* .view-all-products{
            margin-top: 800px !important;
        } */
        .ecommerce-home {
            min-height: 100px;
        }
    }

    @media only screen and (max-width: 767px) {

        /* .view-all-products{
            margin-top: 800px !important;
        } */
        .img-fluid {
            height: 40vh;
            object-fit: cover;
        }

        #promotion_card .col-md-6 {
            flex-basis: 50%;
            max-width: 50%;
        }
    }

    .img-fluid {
        width: 100%;
        height: 50%;
        object-fit: cover;
    }

    #banner_img .nav-item {
        display: none;
    }


    /* CSS for side-by-side cards on large screens */
/* @media (min-width: 992px) {
    .promotion_card .col-md-6 {
        flex: 0 0 100%;
        max-width: 100%;
    }
} */

/* CSS for stacked cards on smaller screens */
/* @media (max-width: 991px) {
    .promotion_card .col-md-6 {
        flex: 0 0 50%;
        max-width: 50%;
    }
} */





    
    .image-container {
        width: 100%;
        /* or any specific width you want */
        position: relative;
    }

    .image-container:before {
        content: "";
        display: block;
        padding-top: 45.25%;
        /* 9/16 = 0.5625; 16:9 aspect ratio */
    }

    .carousel_img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Ensure the image covers the container */
    }


   
</style>