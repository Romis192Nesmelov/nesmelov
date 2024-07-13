@extends('layouts.main')

@section('content')
    @include('blocks._video_block')

{{--    @include('blocks._news_block')--}}

    @for ($i=0;$i<count($data['branches']);$i++)
        @if (!$i)
            <?php ob_start(); ?>
            @foreach($data['branches'] as $branch)
                @if ($branch->id != 1 && count($branch->works))
                    @include('blocks._big_icon_block', [
                        'icon' => $branch->icon,
                        'href' => $branch->eng,
                        'subscribe' => $branch->description
                    ])
                @endif
            @endforeach
            @include('blocks._gray_block', ['head' => 'Основные направления профессиональной деятельности', 'content' => ob_get_clean()])
        @endif

        @include('blocks._branch_block', [
            'addClass' => ($i % 2 ? 'pull-right' : ''),
            'branch' => $data['branches'][$i],
            'next' => $i<count($data['branches'])-1 ? $data['branches'][$i+1]->eng : null
        ])

        @if (count($data['branches'][$i]->works))
            <?php ob_start(); ?>
            <div class="portfolio">
                @foreach($data['branches'][$i]->works as $k => $work)
                    @if ($work->active)
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                            <a href="{{ $work->url ? $work->url : asset($work->full) }}" {{ $work->url ? 'target=_blank' : 'class=img-preview' }} title="{{ $work->description }}"><img src="{{ asset($work->preview) }}" /></a>
                        </div>
                    @endif
                @endforeach
            </div>
            @if ($data['branches'][$i]->full_portfolio)
                <p class="text-center">Более полное портфолио вы можете увидеть <a href="{{ $data['branches'][$i]->full_portfolio }}" target="_blank">здесь</a></p>
            @endif
            @include('blocks._gray_block', ['head' => 'Работы из портфолио «'.$data['branches'][$i]->rus.'»', 'content' => ob_get_clean()])
        @endif
    @endfor
@endsection