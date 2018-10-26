function OnDateEdit(arParams) {

    var obButton1 = arParams.oCont.appendChild(BX.create('BUTTON', {
        html: 'Выбрать дату'
    }));

    var obLabel1 = arParams.oCont.appendChild(BX.create('SPAN', {
        html: '&nbsp;&nbsp;&nbsp;&nbsp;' + arParams.oInput.value
    }));

    obButton1.onclick = BX.delegate(function () {
        BX.calendar({
            node: obButton1,
            field: arParams.oInput,
            callback_after: function () {
                obLabel1.innerHTML = '&nbsp;&nbsp;&nbsp;&nbsp;' + arParams.oInput.value;
            }
        });
        return false;
    });

}

function OnTextAreaConstruct(arParams) {
    var iInputID = arParams.oInput.id;
    var iTextAreaID = iInputID + '_ta';

    var obLabel = arParams.oCont.appendChild(BX.create('textarea', {
        props: {
            'style': 'width: 90%',
            'rows': 10,
            'id': iTextAreaID
        },
        html: arParams.oInput.value
    }));

    $("#" + iTextAreaID).on('keyup', function () {
        $("#" + iInputID).val($(this).val());
    });
}

function OnTextEdit(arParams) {

    this.arParams = arParams;

    var obLabel1 = arParams.oCont.appendChild(BX.create('p', {
        html: arParams.oInput.value + '<br />'
    }));

    var obButton = document.createElement('BUTTON');
    this.arParams.oCont.appendChild(obButton);
    obButton.innerHTML = 'Открыть редактор';


    obButton.onclick = BX.delegate(function () {

        var post = 'fieldName=' + arParams.data;
        if (arParams.oInput.value) post = post + '&TEXT=' + arParams.oInput.value;

        window.jsPopupTextarea = new BX.CDialog({
            'content_url': '/bitrix/components/dex/data/textarea.php',
            'content_post': post,
            'width': 800,
            'height': 500,
            'resizable': false,
            'buttons': [{
                title: 'Сохранить',
                name: 'save',
                id: 'save',
                action: function () {
                    obLabel1.innerHTML = redactor.content;
                    arParams.oInput.value = redactor.content;
                    BX.WindowManager.Get().Close()
                }
            }]
        }).Show();

        return false;

    });
}