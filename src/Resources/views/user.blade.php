user index 视图 {{ $username }}--{{ $age }}
@if($age==18)
    18一枝花
@elseif($age>18)
    都是成年人了
@else 
    未满 18
@endif

<!--取反-->
@unless($age<18)
    age 大于18
    @endunless

@isset($age)
    变量设置
@endisset