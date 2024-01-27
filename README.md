# AliceFramework
Tiny framework for Yandex Alice

### What is implemented
- text
- tts

### Deploing
1. Clone
2. Set up routing on your server to `AliceFramework/index.php`
3. Create new skill in `https://dialogs.yandex.ru/developer/`
4. Enjoy hacking

### Adding your own сommands
1. Add new command to `src/AliceFramework/Commands/` using examples `Example.php` and `RandomQuote.php` (`start` method must be present)
2. Add path to new command class in `src/AliceFramework/Commands/CommandList.php`
