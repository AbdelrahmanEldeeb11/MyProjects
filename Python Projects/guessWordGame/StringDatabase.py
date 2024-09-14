class StringDatabase:
    def __init__(self):
        self.words = []
        self._load_words()

    def _load_words(self):
        with open("four_letters.txt", "r") as file:
            lines = file.read().splitlines()
            for line in lines:
                self.words.extend(line.split())

    def get_random_word(self):
        import random
        return self.words[random.randrange(0, len(self.words))]

