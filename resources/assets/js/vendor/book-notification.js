module.exports = {
    init() {
        //se o ID estiver disponível para gerar o token
        let existsUserId = window.Laravel.userId;
        if (existsUserId !== null) {
            window.Echo.private('CodeEduUser.Models.User.' + existsUserId)
                .notification(function (notification) {
                    window.$.notify({message: 'O livro ' + notification.book.title + ' foi exportado '},
                        {type: 'success'});
                })
        }
    }
};