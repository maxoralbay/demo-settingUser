@extends('layouts.app')
@section('content')
    <h2 class="mb-4">Форма настройки пользователя</h2>
    <form id="user-setting">
        @csrf
        <!-- Field 1: Name -->
        <div class="mb-3">
            <label for="key1" class="form-label">Устновка 1</label>
            <input type="text" class="form-control" id="key1" name="key1" required>
        </div>

        <!-- Field 2: Email -->
        <div class="mb-3">
            <label for="key2" class="form-label">Устновка 2</label>
            <input type="key2" class="form-control" id="key2" name="key2" required>
        </div>
        {{--        methods ['sms', 'email', 'telegram']--}}
        <div class="mb-3">
            <label for="method" class="form-label">Способ отправки кода</label>
            <select class="form-select" id="method" name="method" required>
                <option value="telegram">Telegram</option>
                <option value="email">Email</option>
                <option value="sms">SMS</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="method-address" class="form-label" id="method-address-label">Аккаунт отправки</label>
            <input type="text" class="form-control" id="method-address" name="method-address">
        </div>
        <!-- Field 3: Code -->
        <div class="mb-3">
            <label for="code" class="form-label">Код</label>
            <input type="text" class="form-control" id="code" name="code">
            <a href="#" id="sendCode" class="mt-3">Получить код</a>
        </div>
        <!-- Buttons -->
        <button type="submit" class="btn btn-primary">Сохранить</button>

    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // load data from local storage after reload
            if (localStorage.getItem('userSetting')) {
                saveData();
            }
            const csrf = document.querySelector('input[name="_token"]').value;
            // send code
            document.getElementById('sendCode').addEventListener('click', function (e) {
                e.preventDefault();
                let codeData = {};
                codeData['method'] = document.getElementById('method').value;
                codeData['method_address'] = document.getElementById('method-address').value;
                codeData['user_id'] = {{ $userId }};
                fetch('/api/user/send/notification', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf
                    },
                    body: JSON.stringify(codeData)
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.data) {

                            console.log(data.data);
                        } else {
                            console.log('Failed to send code');
                        }
                    });
            });
            // save form
            document.getElementById('user-setting').addEventListener('submit', function (e) {
                e.preventDefault();
                // convert FormData to JSON
                const jsonData = {};
                (new FormData(this)).forEach((value, key) => {
                    jsonData[key] = value;
                });
                fetch('{{ route('user.setting.update', ['userId' => $userId]) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf
                    },
                    body: JSON.stringify(jsonData)
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.data) {
                            // update the form with the new data
                            dataForm = data.data;
                            // save the data to local storage for later use
                            console.log(dataForm);
                            localStorage.setItem('userSetting', JSON.stringify(dataForm));
                            saveData();

                        } else {
                            alert('Failed to save data');
                        }
                    });
            });

        })

        function saveData() {
            const data = JSON.parse(localStorage.getItem('userSetting'));
            if (data) {
                document.getElementById('key1').value = data.key1;
                document.getElementById('key2').value = data.key2;

            }
        }
    </script>
@endsection
