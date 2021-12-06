@extends('layouts.app')
@section('title') Админпанель @endsection
@section('content')
    @include('includes.admin_btn')
    @if(isset($throwable))
        <p>Ошибка в вводе переменной fields</p>
    @endif
    @if(isset($columns))
        <section class="py-2 text-center container">
            <div class="mx-auto">
                <div class="mx-auto">
                    <form action="{{ route('set-fields') }}" method="post">
                        @csrf
                        <div class="btn-group d-block" role="group" aria-label="Basic checkbox toggle button group">
                            @foreach($columns as $column)
                                <input type="checkbox" class="btn-check" name="{{$column}}" id="{{$column}}"
                                       @foreach($get_fields as $field)
                                       @if($field == $column)
                                       checked
                                       @endif
                                       @endforeach
                                       value="{{$column}}" autocomplete="off">
                                <label class="btn btn-outline-primary" for="{{$column}}">{{$column}}</label>
                            @endforeach
                        </div>
                        <div class="d-block">
                            <input class="form-check-input" type="checkbox" value="show_category" name="show_category" id="show_category"
                                   @if($show_category == true)
                                   checked
                                @endif>
                            <label class="form-check-label" for="show_category">
                                Показать категории
                            </label>
                        </div>
                        <button class="btn btn-sm btn-outline-secondary d-block m-auto mt-2">Выбрать поля</button>
                    </form>
                </div>
            </div>
        </section>
    @endif
    {{--start table--}}
    <table class="table">
        @if($data_table->count() != 0)
            <thead>
            <tr>
                @isset($data_table[0]->id)<th scope="col">id</th>@endisset
                @isset($data_table[0]->product)<th scope="col">product</th>@endisset
                @isset($data_table[0]->description)<th scope="col">description</th>@endisset
                @isset($data_table[0]->number)<th scope="col">number</th>@endisset
                @isset($data_table[0]->price)<th scope="col">price</th>@endisset
                    @if($show_category == true)
                        @isset($data_table[0]->categories->category)<th scope="col">category</th>@endisset
                    @endif
                @isset($data_table[0]->image_path)<th scope="col">image_path</th>@endisset
                @isset($data_table[0]->created_at)<th scope="col">created_at</th>@endisset
            </tr>
            </thead>
            <tbody>
            @foreach($data_table as $row)
                <tr>
                    @isset($row->id)<th scope="row">{{$row->id}}</th>@endisset
                    @isset($row->product)<td>{{$row->product}}</td>@endisset
                    @isset($row->description)<td>{{$row->description}}</td>@endisset
                    @isset($row->number)<td>{{$row->number}}</td>@endisset
                    @isset($row->price)<td>{{$row->price}}</td>@endisset
                        @if($show_category == true)
                            @isset($row->categories->category)<td>{{$row->categories->category}}</td>@endisset
                        @endif
                    @isset($row->image_path)<td><a href="{{asset('storage/images/'.$row->image_path)}}">Фото</a></td>@endisset
                    @isset($row->created_at)<td>{{$row->created_at}}</td>@endisset
                </tr>
            @endforeach
            </tbody>
        @else
            <p>Таблица пуста</p>
        @endif
    </table>
    {{--end table--}}

    {{--start pagination--}}
    <div class="pagination_upper text-center mb-5">
        <div class="pagination mt-5 m-auto">
            @if($data_table->lastPage() > 1)
                @if($data_table->currentPage()> 1)
                    @foreach($data_table->links()->elements as $element)
                        @foreach($element as $key => $page)
                            @if($key ==$data_table->currentPage()-1)
                                <a href="{{$page}}">
                                    <button class="btn btn-outline-primary me-3">Previous</button>
                                </a>
                            @endif
                        @endforeach
                    @endforeach
                @endif
                @foreach($data_table->links()->elements as $element)
                    @if($element == "...")
                        <a href="">
                            <button class="btn btn-outline-info">...</button>
                        </a>
                    @else
                        @foreach($element as $key => $page)
                            <a href="{{$page}}">
                                <button class="btn btn-outline-info">{{ $key }}</button>
                            </a>
                        @endforeach
                    @endif
                @endforeach
                @if($data_table->currentPage()< $data_table->lastPage())
                    @foreach($data_table->links()->elements as $element)
                        @foreach($element as $key => $page)
                            @if($key ==$data_table->currentPage()+1)
                                <a href="{{$page}}">
                                    <button class="btn btn-outline-primary ms-3">Next</button>
                                </a>
                            @endif
                        @endforeach
                    @endforeach
                @endif
            @endif
        </div>
    </div>
    {{--end pagination--}}
@endsection
