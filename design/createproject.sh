folders=( contacts conversation fullcat fullnews news registration selectconversation thanksreg );
for i in "${folders[@]}"
do 
mkdir -p $i/{framework,base,components}
touch  $i/app.scss ./$i/base/_variables.scss
done;

