@extends('layouts.innerFront')
@section('content')

<style>
    /* Custom styles for blog show page */

    /* Featured Image */
    .s-content__post-thumb img {
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
    }

    .s-content__post-thumb img:hover {
        transform: scale(1.05);
    }

    /* Entry Title */
    .s-content__title {
        font-size: 2.5rem;
        color: #333;
        margin-bottom: 20px;
    }

    /* Entry Meta */
    .entry-author a {
        color: #666;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .entry-author a:hover {
        color: #FF6B6B;
    }

    /* Gallery Images */
    .gallery-images-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-top: 30px;
    }

    .gallery-images-container .col-md-3 {
        flex: 0 0 calc(25% - 20px);
        margin-bottom: 20px;
    }

    .gallery-images-container img {
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
    }

    .gallery-images-container img:hover {
        transform: scale(1.05);
    }
</style>

<section class="s-content">
    <div class="row">
        <div class="column large-12">

            <article class="s-content__entry format-standard">
                <div class="s-content__media">
                    <div class="s-content__post-thumb text-center">
                        <img src="{{ asset('assets/uploads/featured_image/'.$post->featured_image) }}" class="featured_image" alt="Image here" style="width: 100%; max-width: 800px; height: auto;">
                    </div>
                </div> <!-- end s-content__media -->

                <div class="s-content__entry-header">
                    <h1 class="s-content__title s-content__title--post">{{ $post->title }}</h1>
                </div> <!-- end s-content__entry-header -->

                <div class="s-content__primary">

                    <div class="s-content__entry-content">
                        <p class="lead">{{ optional($post->category)->title }}</p>
                        <p class="lead">{{ optional($post->tag)->tag }}</p>
                        <p>{{ $post->short_description }}</p>
                        <p>{{ $post->detailed_description }}</p>
                        <p>{{ $post->slug }}</p>
                        <p>{{ $post->seo_title }}</p>
                        <p>{{ $post->seo_keywords }}</p>
                        <p>{{ $post->seo_description }}</p>
                    </div> <!-- end s-entry__entry-content -->
                    
                    <p>Gallary Images</p>
                    <div class="gallery-images-container">
                        @if ($post->images->isNotEmpty())
                            @foreach ($post->images as $image)
                                <div class="col-md-3">
                                    <img src="{{ asset('assets/uploads/gallery_images/'.$image->gallery_images) }}" class="img-fluid" alt="Gallery Image" style="width: 100%; max-width: 200px; height: auto;">
                                </div>
                            @endforeach
                        @else
                            <p>No gallery images available.</p>
                        @endif
                    </div>

                    <div class="s-content__entry-meta">
                        <div class="entry-author meta-blk">
                            <div class="byline">
                                <span class="bytext">Posted By</span>
                                <a href="#0">{{ $post->user->name }}</a>
                            </div>
                        </div>
                    </div>
                </div> <!-- end s-content__primary -->
            </article>
        </div>
    </div>
</section>
@endsection
