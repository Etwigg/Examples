#  File: Blackjack.py
#  Description: Runs a game of blackjack
#  Student's Name: Ethan Wiggins
#  Student's UT EID: ecw583
#  Course Name: CS 313E
#  Unique Number: 50940
#
#  Date Created:2/15/16
#  Date Last Modified:2/19/16

import random


# Main class for cards, no value method here to account for ace choice


class Card:
    def __init__(self):
        self.suit = random.sample(['S', 'D', 'H', 'C'], 1)
        self.pip = random.sample(['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'], 1)


# Creates a Deck made of Card object values (one pip and one suit)
# Loops creation of random card until list has all 52 non-repeating cards


class Deck:
    def __init__(self):
        self.deck_list = []
        while len(self.deck_list) < 52:
            card_i = Card()
            if (card_i.pip + card_i.suit) in self.deck_list:
                pass
            else:
                self.deck_list.append((card_i.pip + card_i.suit))


# Player class stores score and hand


class Player:
    def __init__(self):
        self.score = 0
        self.hand = []


# Function to prompt the player if they want their ace to be valued at 1 or 11


def aceChoice():
    choice = 0
    while choice != 1 or choice != 11:
        choice = input('Would you like the ace to count as 1 or 11?')
        return int(choice)


# Function to move one random set of card values (pip and suit) from the deck list to a players hand
# and to remove the drawn card from the deck


def dealOne(deck):
    card = random.sample(deck.deck_list[0:], 1)
    deck.deck_list.remove(card[0])
    return card


# Function to read the pip value of a single card and return the point value


def getValue(card):
        points = 0
        if card == 'J' or card == 'Q' or card == 'K':
            points += 10
        elif card == 'A':
            points += aceChoice()
        else:
            points += int(card)
        return points

# Function to calculate the dealers hand separately, accounting for aces


def dealerScore(hand):
    points = 0
    hand_new = []
    hand_new.append(hand[::2])
    if 'A' in hand_new:
        for j in range(hand_new.count('A')):
            hand_new.insert(len(hand_new[0]), hand_new.pop(hand_new.index('A')))
    for i in hand_new[0]:
        if i == 'J' or i == 'Q' or i == 'K':
            points += 10
        elif i == 'A':
            if points + 11 <= 21:
                points += 11
            else:
                points += 1
        else:
            points += int(i)
    return points


# Main game loop
def main():
    play = True
    while play is True:
        choice = input("Would you like to play a hand of Blackjack? (Y/N) ")
        if choice == "N":
            play = False
            continue
        elif choice == "Y":
            pass
        else:
            print("That is not a valid input!")
            continue
        # Generate the deck or cards and the two player objects
        deck = Deck()
        player = Player()
        dealer = Player()
        # Display deck list and number of cards upon initialization (already randomized)
        print('Shuffled initial deck: Length = ', len(deck.deck_list), '\n', deck.deck_list)
        # Deals one card (face up) to dealer and player
        player.hand.append(dealOne(deck))
        dealer.hand.append(dealOne(deck))
        # Displays deck list and number of cards after two are removed from deck list and moves into the dealer/players hand
        print('Deck after dealing first two cards: Length = ', len(deck.deck_list), '\n', deck.deck_list)
        # Display first two cards drawn face up
        print('Dealer shows', dealer.hand[0][0][0] + dealer.hand[0][0][1], 'face up')
        print('You show', player.hand[0][0][0] + player.hand[0][0][1], 'face up')
        print('You go first.')
        # Deals the second card (face down) to the dealer and player and updates their hands value
        player.hand.append(dealOne(deck))
        dealer.hand.append(dealOne(deck))
        print('You are dealt a', player.hand[1][0][0] + player.hand[1][0][1])
        player.score = getValue(player.hand[0][0][0]) + getValue(player.hand[1][0][0])
        dealer.score = dealerScore(dealer.hand[0][0] + dealer.hand[1][0])
        print('You hold', player.hand[0][0][0] + player.hand[0][0][1], player.hand[1][0][0] + player.hand[1][0][1],
          'for a total of', player.score)
        # Check possible game states and begins player turn
        while player.score != 21 and dealer.score != 21:
                choice = input('Would you like to hit(1) or stay(2)?)')
                if choice == '1':
                    player.hand.append(dealOne(deck))
                    hold = []
                    for i in range(len(player.hand)):
                        hold.append(player.hand[i][0][0] + player.hand[i][0][1])
                    print('You were dealt', player.hand[-1][0][0] + player.hand[-1][0][1])
                    player.score = int(getValue(player.hand[0][0][0])) + int(getValue(player.hand[1][0][0])) + int(getValue(player.hand[2][0][0]))
                    print('Your score is now', player.score)
                    if player.score == 21:
                        break
                    elif player.score > 21:
                        print('You Bust!')
                        return
                    else:
                        continue
                elif choice == '2':
                    print('Dealers hand is: ', dealer.hand[0][0][0] + dealer.hand[0][0][1], '', dealer.hand[1][0][0] + dealer.hand[1][0][1])
                    break
        else:
            if player.score == 21 and dealer.score != 21:
                print('Blackjack! You win!')
            elif player.score != 21 and dealer.score == 21:
                print('Dealer got a blackjack! You lose!')
            elif player.score == 21 and dealer.score == 21:
                print('You and the dealer got blackjack! Push!')
        # Dealers turn
        while dealer.score != 21:
            if dealer.score < 17:
                sample = []
                dealer.hand.append(dealOne(deck))
                hold = []
                for i in range(len(dealer.hand)):
                    hold.append(dealer.hand[i][0][0] + dealer.hand[i][0][1])
                print('Dealer hits: ', dealer.hand[-1][0][0] + dealer.hand[-1][0][1])
                for j in range(len(dealer.hand)):
                    sample += dealer.hand[j][0]
                dealer.score = dealerScore(sample)
                print('Dealers new total: ', dealer.score)
            elif dealer.score > 21:
                print('Dealer Busts! You win!')
                return
            elif dealer.score < player.score:
                print('Dealer has', dealer.score, ', you win!')
                return
            elif dealer.score == player.score:
                print('Push!')
                return
            else:
                print('Dealer has', dealer.score, ', you lose!')
                return
main()



