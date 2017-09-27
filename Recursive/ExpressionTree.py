#  File: ExpressionTree.py
#  Description: Solves simple math problems using binary trees
#  Student's Name: Ethan Wiggins
#  Student's UT EID: ecw583
#  Course Name: CS 313E
#  Unique Number: 50940
#
#  Date Created:4/28/16
#  Date Last Modified:4/29/16


class BinaryTree:

    def __init__(self, initVal, parent=None):
        self.data = initVal
        self.left = None
        self.right = None
        self.parent = parent

    def insertLeft(self, newNode):
        if self.left is None:
            self.left = BinaryTree(newNode, parent=self)
        else:
            self.left.insertLeft(newNode)

    def insertRight(self, newNode):
        if self.right is None:
            self.right = BinaryTree(newNode, parent=self)
        else:
            self.right.insertRight(newNode)

    def getLeftChild(self):
        return self.left

    def getRightChild(self):
        return self.right

    def setRootVal(self, value):
        self.data = value

    def getRootVal(self):
        return self.data


class Stack:
    def __init__(self):
        self.items = []

    def push(self, item):
        self.items.append(item)

    def pop(self):
        if self.size() > 0:
            return self.items.pop(-1)

    def peak(self):
        return self.items[-1]

    def isEmpty(self):
        return self.items == []

    def size(self):
        return len(self.items)

    def remove(self, item):
        return self.items.remove(item)

    def __str__(self):
        return str(self.items)


array = []


def preorder(tree):
    if tree is not None:
        array.append(tree.getRootVal())
        preorder(tree.getLeftChild())
        preorder(tree.getRightChild())


def inorder(tree):
    if tree is not None:
        inorder(tree.getLeftChild())
        array.append(tree.getRootVal())
        inorder(tree.getRightChild())


def postorder(tree):
    if tree is not None:
        postorder(tree.getLeftChild())
        postorder(tree.getRightChild())
        array.append(tree.getRootVal())


def postfixEval(postfixExpr):
    operators = ['+', '-', '*', '/']
    operandStack = Stack()
    tokenList = postfixExpr.split()
    for token in tokenList:
        if token in operators:
            operand2 = operandStack.pop()
            operand1 = operandStack.pop()
            result = doMath(token, operand1, operand2)
            operandStack.push(result)
        else:
            operandStack.push(eval(token))
    return operandStack.pop()


def prefixEval(prefixExpr):
    operators = ['+', '-', '*', '/']
    operandStack = Stack()
    tokenList = prefixExpr.split()
    tokenList.reverse()
    for token in tokenList:
        if token in operators:
            operand2 = operandStack.pop()
            operand1 = operandStack.pop()
            result = doMath(token, operand1, operand2)
            operandStack.push(result)
        else:
            operandStack.push(int(token))
    return operandStack.pop()


def doMath(op, op1, op2):
    if op is not None and op1 is not None and op2 is not None:
        if op == '*':
            return op1 * op2
        elif op == '/':
            return op1 / op2
        elif op == '+':
            return op1 + op2
        else:
            return op1 - op2


def createTree(line):
    operators = ['+', '-', '*', '/']
    stack = Stack()
    tokens = line.split()
    current = BinaryTree(tokens[0], parent=None)
    root = current
    for token in tokens:
        if token == ')':
            current = current.parent
            stack.pop()

        if token == '(':
            current.insertLeft(token)
            stack.push(current)
            current = current.getLeftChild()

        if token in operators:
            current.setRootVal(token)
            stack.push(current)
            current.insertRight(token)
            current = current.getRightChild()

        if token not in operators and token != '(' and token != ')':
            current.setRootVal(token)
            current = current.parent
            stack.pop()
    return root


def resetglobal():
    global array
    array = []


def evaluate(tree):
    postorder(tree)
    print('Value: ', postfixEval(' '.join(array)))
    print('Postfix expression: ', ' '.join(array))
    resetglobal()
    preorder(tree)
    print('Prefix expression: ', ' '.join(array))
    print('\n')
    resetglobal()




def main():
    data = open('treedata.txt', 'r')
    for line in data:
        tree = createTree(line)
        print('Infix Expression: ', line)
        evaluate(tree)


main()

