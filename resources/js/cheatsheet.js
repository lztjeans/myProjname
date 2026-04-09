console.log("--- My JS is Running ---");

$(document).ready(function () {
    console.log("JS 已載入，準備綁定按鈕...");
    // 監聽綠色按鈕的點擊事件
    $('#submit-btn').on('click', function (e) {
        console.log('按鈕被點擊了！');
        //e.preventDefault();
        
        const btn = $(this);
        const mode = $('#current-mode').val();
        const id = $('#item-id').val();

        // 1. 準備資料
        const payload = {
            category: $('#category').val(), // 建議給這個 input 一個 id="category"
            commandName: $('#title').val(),
            description: $('#description').val(),
        };

        // 2. 根據模式決定 URL 與 Method
        let apiUrl = '/api/cheatsheets';
        let httpMethod = 'POST'; // 新增模式

        if (mode === 'edit') {
            apiUrl = `/api/cheatsheets/${id}`;
            httpMethod = 'PUT'; // 編輯模式
            payload.updater = 'SystemUser2'; // 這裡可以根據實際情況動態設定更新者名稱
        }else{
            // 如果是 create 模式，確保 id 是空的，以防萬一
            payload.id = null;
            payload.creater = 'SystemUser1'; // 這裡可以根據實際情況動態設定創建者名稱
        }

        // 3. 停用按鈕防止重複點擊
        btn.prop('disabled', true).addClass('opacity-50');

        // 4. 發送請求
        $.ajax({
            url: apiUrl,
            type: httpMethod,
            data: payload,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                // 如果你之前提到的 Header 需求還在，可以在此加入
                'X-Creater-Name': 'SystemUser' 
            },
            success: function (response) {
                // alert(mode === 'create' ? '建立成功！' : '修改成功！');
                // // 成功後導回列表頁
                // window.location.href = `/cheatsheets/list`;
                if(mode === 'create'){
                    alert('建立成功！'+`${response.id}`);
                    window.location.href = `/cheatsheets/create`;
                }else{
                    alert('修改成功！');
                    window.location.href = `/cheatsheets/${id}`;
                }
            },
            error: function (xhr) {
                const errorMsg = xhr.responseJSON?.message || '發生錯誤，請稍後再試';
                alert('失敗：' + errorMsg);
                console.error(xhr.responseText);
            },
            complete: function () {
                // 恢復按鈕狀態
                btn.prop('disabled', false).removeClass('opacity-50');
            }
        });
    });
});