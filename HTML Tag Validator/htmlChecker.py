#  File: htmlChecker.py
#  Description: Reads a text file containing HTML and checks the tags for their complements as well as visualize the
#       stack data structure
#  Student's Name: Ethan Wiggins
#  Student's UT EID: ecw583
#  Course Name: CS 313E
#  Unique Number: 50940
#  Date Created:3/3/16
#  Date Last Modified:9/14/17

# Used to compare tags as they're encountered
class Stack:
    def __init__(self):
        self.items = []

    def push(self, item):
        self.items.append(item)

    def pop(self):
        return self.items.pop(-1)

    def peak(self):
        return self.items[-1]

    def isEmpty(self):
        return self.items == []

    def size(self):
        return len(self.items)

    def remove(self, item):
        return self.items.remove(item)

# Removes non-tag elements from a line in the text file
def filterTags(st):
    s = []
    while st.find('<') != -1 and st.find('>') != -1:
        i1 = st.find('<')
        i2 = st.find('>')
        if 'meta' in st[i1:i2+1]:
            break
        elif 'br' in st[i1:i2+1]:
            break
        elif 'hr' in st[i1:i2+1]:
            break
        else:
            s.append(st[i1:i2+1])
            st = st.replace('<', '', 1)
            st = st.replace('>', '', 1)
            st = st.strip()
    return s

# Gets a list of tags found that are not exceptions
def getValidTags(file):
    text = open(file, 'r')
    tag_dict = {}
    for line in text:
        st = filterTags(line)
        for tag in st:
            if tag in tag_dict:
                tag_dict[tag] += 1
            else:
                tag_dict[tag] = 1
    ValidTags = list(tag_dict.keys())
    text.close()
    return ValidTags

# Gets all tags in order they are encountered, feeds into stack
def getTags(file):
    text = open(file, 'r')
    st = []
    for line in text:
        st += filterTags(line)
    text.close()
    return st

def main():
        stack = Stack()
        VALIDTAGS = getValidTags('htmlfile.txt')
        tags = getTags('htmlfile.txt')
        EXCEPTIONS = ['<meta>', '<br/>', '<hr>', '<td>']
        # Iterate through the list of tags and put them on the stack
        for tag in tags:
            # When an end tag is found, check for its compliment and remove them both from the stack
            if '/' in str(tag):
                complement = tag.replace('/', '')
                complement = complement.strip()
                if complement in stack.items:
                    stack.items.remove(complement)
                    print('Tag is: ', tag, ':', 'Matches: stack is now', stack.items)
            # Push non end tags onto the stack
            else:
                stack.push(tag)
                print('Tag is: ', tag, ':', 'Pushed: stack is now \n', stack.items)
        # Once all tags are gone through check if the stack is empty or not
        if len(stack.items) > 0:
            print('Processing complete. Unmatched tags remain on stack: \n', stack.items)
        elif len(stack.items) < 1:
            print('Processing complete. No mismatches found.\n')
        # List of valid tags and exceptions
        print('List of Valid Tags:\n')
        print(VALIDTAGS, '\n')
        print('List of Exceptions:\n')
        print(EXCEPTIONS, '\n')

main()



