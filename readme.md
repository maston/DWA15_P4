# LunchMoneyGame

## Live URL
<http://beta.lunchmoneygame.com/>

## Demo
tbd

## Description

LunchMoneyGame is a tool and process that teaches how to reverse the behaviors around spending money on restaurant food. Using the relationship with money to influence the relationship with food choices, it is a simple system of self-reward that can reverse downward trends in one’s health.

### How it works

“When I cook at home, I don’t spend $20.” Learning to cook a meal at home puts the money you didn’t spend on take-out or a restaurant back in your pocket. Every cup of coffee you brew at work or home is $2 you didn’t spend at a coffee shop. This adds up. LunchMoneyGame is a tool that collects your points as you perform the behavior of home cooking and counts those actions against a weekly Grocery Run.

Example of Cooking One Meal

Our user will be cooking a simple meal of “Sausage Pasta” which is a jar of sauce, a pasta, a chicken sausage grilled, and a frozen veggie.

Grocery Run on a Sunday for ingredients = $20
Dinner on that Sunday for 2 people = 2 LMG dinner points
Leftovers taken to lunch Monday for 2 people = 2 LMG lunch points
Coffee brewed on Monday morning and taken in travel mugs = 2 LMG coffee points
The "average spend" settings for this user are:

Dinner = $20
Lunch = $10
Coffee = $2.50
The Results for Run

Dinner (2 * $20) + Lunch (2 * $10) + Coffee (2 * $2.50) = $65 not spent on restaurant food.

If our user repeats this process for a month the total is $260.
If our user learns to cook more meals… this number starts to go up. 
LunchMoneyGame keeps track.

## Details for teaching team
Test Login users:  
user: jill@harvard.edu
pwd: helloworld

user: jamal@harvard.edu
pwd: helloworld

## Known Issues
A user can add duplicate Grocery Runs.  This is not desired.
When using the "unique" validation on grocery run dates, it was blocking other users from making a grocery run on the same date.
Need a composite key uniqueness constraint.

## Outside Code & Resources

### Packages included in project
none 

### HTML/css/images
* using HTML 5
* Bootstrap: http://getbootstrap.com/
