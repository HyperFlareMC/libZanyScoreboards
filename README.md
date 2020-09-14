# libZanyScoreboards

libZanyScoreboards is a virion that targets creating and manipulating Scoreboards with easy.


## API

libZanyScoreboards provides a very basic API that is intended to be used quickly and efficiently.

### Import

Before you start, you need to import your `Scoreboard` class, luckily this is the only class to import, so it's not difficult: 

```use HyperFlareMC\libzanyscoreboards\Scoreboard;```

### Scoreboard Construction

You can construct a new `Scoreboard` object to create an initial Scoreboard:

```$scoreboard = new Scoreboard();```

### Adding content to lines

Then, you can set certain values to specific lines on the Scoreboard:

```$scoreboard->addLine($player, $line, $message);```

`$player` is the `Player` object that you want to send the Scoreboard to, `$line` is the line that you want to set it to, and `$message` is the content you want to be on the line.

### Sending to a Player

After you've created your object and set your lines, you're ready to send it to a player:

```$scoreboard->sendToPlayer($player, $objectiveName, $displayName);```

`$player` is the `Player` object that you want to send the Scoreboard to, `$objectiveName` is the behind the scenes title given to the scoreboard, and `$displayName` is the title that will be displayed at the top of the Scoreboard.

### Removing from a Player

To remove a Scoreboard from a Player, use the following:

```$scoreboard->removeFromPlayer($player);```

`$player` is the `Player` object that you want to remove the Scoreboard from.

## Contributions

Contributions are always welcome! Feel free to open an issue if you have a suggestion or issue, and a PR if you want to contribute code-wise.
