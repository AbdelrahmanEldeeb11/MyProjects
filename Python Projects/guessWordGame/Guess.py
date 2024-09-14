
class Guess:
    def __init__(self, word):
        self.name_to_guess = word
        self.name_guessed = "----"
        self.guesses_made = [""]   #List to store guesses made
        self.bad_guesses = 0       #Count of incorrect guesses
        self.missed_letters = 0    #Count of missed letter guesses
        self.status = ""           #Gave up or gussed correctly
        self.score = 0
        self.letters_guessed = ''

    def calculate_initial_score(self, frequencies):
        self.score = sum(frequencies.get(l, 0) for l in self.name_to_guess)

    def update_guess(self, letter, frequencies):
        matches = 0  # Count of matched letters
        for i, l in enumerate(self.name_to_guess):
            if letter == l:
                self.name_guessed = self.name_guessed[:i] + letter + self.name_guessed[i + 1:]
                matches += 1
                self.score -= frequencies.get(letter, 0)
        return matches

    def finalize_score(self, bad_guesses_count, missed_letters_count):
        if self.missed_letters != 0:
            self.score /= missed_letters_count
        self.score *= ((100 - (10 * bad_guesses_count)) / 100)
