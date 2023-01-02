<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Poll;
use App\Models\Page;
use App\Models\Answer;
use App\Models\Button;
use App\Models\Category;
use App\Models\SocialMedia;
use App\Constants\PagesConstant;
use App\Models\HomeAdvertisement;
use App\Models\StreamingVideo;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    public function getLayout()
    {
        $smallAboutUs = Page::where('page_id', PagesConstant::$smallAbout)->first();
        $socialMedia = SocialMedia::orderBy('id', 'asc')->get();
        $buttons = Button::where('show', true)->orderBy('order', 'asc')->get();
        view()->share('socialMedia', $socialMedia);
        view()->share('smallAboutUs', $smallAboutUs);
        view()->share('buttons', $buttons);
    }

    public function getWeatherService()
    {
        $date = Date('Y-m-d');
        $url = "https://api.open-meteo.com/v1/forecast?latitude=28.19&longitude=-105.47&hourly=temperature_2m&timeformat=unixtime&timezone=auto&start_date=$date&end_date=$date";
        $temperature = 0;

        try {
            $response = Http::get($url);

            if ($response->successful()) {
                $weather = $response->json();
                if (!array_key_exists('error', $weather) || $weather == false) {
                    $lastHourTimestamp = Carbon::now()->subHour()->timestamp;
                    $lastHourTimestamp = $lastHourTimestamp - ($lastHourTimestamp % 3600);
                    $timestamp = array_search($lastHourTimestamp, $weather['hourly']['time']);

                    $newIndex = array_search($timestamp, $weather['hourly']['time']);
                    $temperature = $weather['hourly']['temperature_2m'][$newIndex];
                }
            }
        } catch (\Throwable $th) {
            $temperature = 'N/A';
        }

        view()->share('temperature', $temperature);
    }

    public function getAds()
    {
        $topAds = HomeAdvertisement::where([['status', true], ['typeId', 1]])->get();
        $carouselAds = HomeAdvertisement::where([['status', true], ['typeId', 2]])->get();
        $topSideAd = HomeAdvertisement::where([['status', true], ['typeId', 3]])->first();
        $belowSideAd = HomeAdvertisement::where([['status', true], ['typeId', 4]])->first();
        $footerAd = HomeAdvertisement::where([['status', true], ['typeId', 5]])->first();

        view()->share('topAds', $topAds);
        view()->share('carouselAds', $carouselAds);
        view()->share('topSideAd', $topSideAd);
        view()->share('belowSideAd', $belowSideAd);
        view()->share('footerAd', $footerAd);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        $this->getLayout();
        $this->getWeatherService();
        $this->getAds();

        $categories = Category::where('show', true)->orderBy('order', 'asc')->with('subCategories')->get();
        $globalTags = Tag::orderBy('id', 'asc')->limit(10)->get();
        $recentPosts = Post::orderBy('id', 'desc')->limit(5)->get();
        $popularPosts = Post::orderBy('visitors', 'desc')->limit(5)->get();

        //Poll
        // $poll = Poll::where('active', true)->first();
        // $answers = Answer::where('poll_id', $poll->id)
        //     ->with('results')
        //     ->get();

        view()->share('categories', $categories);
        view()->share('recentPosts', $recentPosts);
        view()->share('popularPosts', $popularPosts);
        view()->share('globalTags', $globalTags);
        // view()->share('poll', $poll);
        // view()->share('answers', $answers);
    }
}
