<?php

namespace App\Http\Controllers;
//use App\Question;
use App\News;
use App\Branch;
use App\Panorama;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Settings;

class StaticController extends Controller
{
    use HelperTrait;

    public function index()
    {
        $this->getIndexData();
        return $this->showView('home');
    }

    public function panorama($slug=null)
    {
        $this->data['panoramas'] = Panorama::where('active',1)->get();
        if ($slug) {
            if (!$this->data['panorama'] = Panorama::where('href',$slug)->where('active',1)->first()) abort(404);
            return $this->showView('panorama');
        } else {
            $this->getIndexData();
            return $this->showView('home');
        }
    }

    public function news($slug)
    {
        $news = News::findBySlug($slug)->toArray();
        $news['date'] = date('d.m.Y', $news['time']);
        return response()->json(['success' => true, 'news' => $news]);
    }

//    public function checkingTasks()
//    {
//        $this->checkTasks();
//    }
//    
    public function antiVir()
    {
        $this->checkVir();
    }

    private function getIndexData()
    {
//        $this->data['questions'] = Question::where('active', 1)->get();
        $this->data['news'] = News::where('active', 1)->where('important', 0)->orderBy('time', 'desc')->get();
        $importantNews = News::where('active', 1)->where('important', 1)->first();
        $this->data['important_news'] = $importantNews ? $importantNews : (count($this->data['news']) ? $this->data['news'][0] : null);
    }

    private function showView($view)
    {
        $this->data['seo'] = Settings::getSeoTags();
        $this->data['branches'] = Branch::where('active',1)->get();
        $mainMenu = [['href' => 'news', 'name' => 'Новости']];
        foreach ($this->data['branches'] as $k => $item) {
            $mainMenu[] = ['href' => $item->eng, 'name' => $item->rus];
        }
//        $mainMenu[] = ['href' => 'faq', 'name' => 'Вопросы и ответы'];
        
        return view($view, [
            'mainMenu' => $mainMenu,
            'data' => $this->data,
            'metas' => $this->metas
        ]);
    }
}
