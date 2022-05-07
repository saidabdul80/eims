@if ($errors->any())
            <hr/>
            @foreach($errors->all() as $err)
                <div class="alert alert-danger">
                    {{ $err}}
                </div>
            @endforeach
        @endif

        @if (session()->exists('success'))
            <hr/>
                <div class="alert alert-success">
                    {{ session('success')}}
                </div>
        @endif

        @if (session()->exists('error'))
            <hr/>
                <div class="alert alert-danger">
                    {{ session('error')}}
                </div>
        @endif

        @if (session()->exists('account_success'))
            <hr/>
                <div class="alert alert-success">
                    {{ session('account_success')}}
                </div>
        @endif