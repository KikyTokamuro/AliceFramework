# AliceFramework
Tiny framework for Yandex Alice

### What is implemented
- text
- tts
- tokens

### Deploying
1. Clone
2. Set up routing on your server to `AliceFramework/index.php`
3. Create new skill in `https://dialogs.yandex.ru/developer/`
4. Enjoy hacking

### Adding your own commands
1. Add new command to `src/AliceFramework/Commands/Executors/` using examples `Example.php` and `RandomQuote.php` (`run` and `__construct` methods must be present)
2. Add path to new command class in `src/AliceFramework/Commands/CommandList.php`
